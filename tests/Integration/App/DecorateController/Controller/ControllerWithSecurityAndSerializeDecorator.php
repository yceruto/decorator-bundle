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
use Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator\HttpSecured;

#[Route('/security-serialize-decorators/default-options')]
class ControllerWithSecurityAndSerializeDecorator
{
    #[HttpSecured]
    #[Serialize]
    public function __invoke(): array
    {
        return ['success' => true];
    }
}
