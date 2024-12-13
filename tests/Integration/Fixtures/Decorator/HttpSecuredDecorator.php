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

namespace Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Yceruto\Decorator\DecoratorInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
final readonly class HttpSecuredDecorator implements DecoratorInterface
{
    public function __construct(
        private RequestStack $requestStack,
    ) {
    }

    public function decorate(\Closure $func): \Closure
    {
        return function (mixed ...$args) use ($func): mixed {
            $request = $this->requestStack->getCurrentRequest();

            if (!$request || 'xyz' !== $request->headers->get('X-API-KEY')) {
                return new Response('Invalid credentials provided.', 401);
            }

            return $func(...$args);
        };
    }
}
