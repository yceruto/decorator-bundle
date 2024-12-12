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

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateController\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Decorator\Serializer\Serialize;

#[Route('/serialize-decorator/custom-options')]
class ControllerWithSerializerDecoratorCustomOptions
{
    #[Serialize(format: 'xml', status: 201, headers: ['X-Foo' => 'bar'])]
    public function __invoke(): array
    {
        return ['success' => true];
    }
}
