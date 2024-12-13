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

use Yceruto\Decorator\Attribute\DecoratorAttribute;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class HttpSecured extends DecoratorAttribute
{
}
