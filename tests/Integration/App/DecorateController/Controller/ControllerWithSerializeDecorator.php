<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Decorator\Serializer\Serialize;

#[Route('/serialize-decorator/default-options')]
class ControllerWithSerializeDecorator
{
    #[Serialize]
    public function __invoke(): array
    {
        return ['success' => true];
    }
}
