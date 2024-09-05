<?php

declare(strict_types=1);

/*
 * This file is part of Decorator Bundle package.
 *
 * (c) Yonel Ceruto <open@yceruto.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yceruto\DecoratorBundle\Decorator\Serializer;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypesInterface;
use Symfony\Component\Serializer\Exception\UnsupportedFormatException;
use Symfony\Component\Serializer\SerializerInterface;
use Yceruto\Decorator\DecoratorInterface;

final readonly class SerializerDecorator implements DecoratorInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private MimeTypesInterface $mimeTypes,
    ) {
    }

    public function decorate(\Closure $func, string $format = 'json', array $context = [], int $status = 200, array $headers = []): \Closure
    {
        $headers['Content-Type'] ??= current($this->mimeTypes->getMimeTypes($format)) ?: throw new UnsupportedFormatException(sprintf('Format "%s" is not supported.', $format));

        return function (mixed ...$args) use ($func, $format, $context, $status, $headers): Response {
            $result = $func(...$args);

            if ($result instanceof RedirectResponse) {
                return $result;
            }

            if (null === $result || '' === $result) {
                return new Response(null, 204, $headers);
            }

            $content = $this->serializer->serialize($result, $format, $context);

            return new Response($content, $status, $headers);
        };
    }
}
