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
use Yceruto\Decorator\DecoratorInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
class FormatGreeting extends DecoratorAttribute implements DecoratorInterface
{
    public function __construct(
        public string $style = 'Important',
    ) {
    }

    public function decorate(\Closure $func, self $format = new self()): \Closure
    {
        $styleFunc = match ($format->style) {
            'Important' => strtoupper(...),
            'Casual' => strtolower(...),
            default => static fn (string $message) => $message,
        };

        return static function (mixed ...$args) use ($func, $styleFunc): mixed {
            $message = $func(...$args);

            return $styleFunc($message);
        };
    }
}
