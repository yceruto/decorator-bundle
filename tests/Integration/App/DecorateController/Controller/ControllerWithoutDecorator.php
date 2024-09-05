<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/no-decorator')]
class ControllerWithoutDecorator
{
    public function __invoke(): Response
    {
        return new Response('OK');
    }
}
