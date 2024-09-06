<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Yceruto\Decorator\DecoratorInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
final readonly class SecuredDecorator implements DecoratorInterface
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
