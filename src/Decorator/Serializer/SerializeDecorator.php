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

final readonly class SerializeDecorator implements DecoratorInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private MimeTypesInterface $mimeTypes,
    ) {
    }

    public function decorate(\Closure $func, Serialize $serialize = new Serialize()): \Closure
    {
        $headers = $serialize->headers;
        $headers['Content-Type'] ??= current($this->mimeTypes->getMimeTypes($serialize->format)) ?: throw new UnsupportedFormatException(sprintf('Format "%s" is not supported.', $serialize->format));

        return function (mixed ...$args) use ($func, $serialize, $headers): Response {
            $result = $func(...$args);

            if ($result instanceof RedirectResponse) {
                return $result;
            }

            if (null === $result || '' === $result) {
                return new Response(null, 204, $headers);
            }

            $content = $this->serializer->serialize($result, $serialize->format, $serialize->context);

            return new Response($content, $serialize->status, $headers);
        };
    }
}
