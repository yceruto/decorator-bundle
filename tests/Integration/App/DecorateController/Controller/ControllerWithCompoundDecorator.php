<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator\SecuredSerialize;

#[Route('/compound-decorators/default-options')]
class ControllerWithCompoundDecorator
{
    #[SecuredSerialize]
    public function __invoke(): array
    {
        return ['success' => true];
    }
}
