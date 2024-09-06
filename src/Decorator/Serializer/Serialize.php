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

namespace Yceruto\DecoratorBundle\Decorator\Serializer;

use Yceruto\Decorator\Attribute\DecoratorMetadata;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class Serialize extends DecoratorMetadata
{
    public function __construct(
        public readonly string $format = 'json',
        public readonly array $context = [],
        public readonly int $status = 200,
        public readonly array $headers = [],
    ) {
    }
}
