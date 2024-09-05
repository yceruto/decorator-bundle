<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Decorator\Serializer\Serialize;
use Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator\Secured;

#[Route('/security-serialize-decorators/default-options')]
class ControllerWithSecurityAndSerializeDecorator
{
    #[Secured]
    #[Serialize]
    public function __invoke(): array
    {
        return ['success' => true];
    }
}
