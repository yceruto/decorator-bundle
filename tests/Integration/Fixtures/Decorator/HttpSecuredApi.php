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

use Yceruto\Decorator\Attribute\Compound;
use Yceruto\DecoratorBundle\Decorator\Serializer\Serialize;

#[\Attribute(\Attribute::TARGET_METHOD)]
class HttpSecuredApi extends Compound
{
    public function getDecorators(array $options): array
    {
        return [
            new HttpSecured(),
            new Serialize(format: 'json'),
        ];
    }
}
