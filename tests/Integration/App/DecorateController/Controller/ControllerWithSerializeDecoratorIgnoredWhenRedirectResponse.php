<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Decorator\Serializer\Serialize;

#[Route('/serialize-decorator/ignored-when-redirect-response')]
class ControllerWithSerializeDecoratorIgnoredWhenRedirectResponse
{
    #[Serialize]
    public function __invoke(): RedirectResponse
    {
        return new RedirectResponse('https://localhost');
    }
}
