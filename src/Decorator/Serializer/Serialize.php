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

use Yceruto\Decorator\Attribute\Decorate;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class Serialize extends Decorate
{
    public function __construct(
        string $format = 'json',
        array $context = [],
        int $status = 200,
        array $headers = [],
    ) {
        parent::__construct(SerializerDecorator::class, [
            'format' => $format,
            'context' => $context,
            'status' => $status,
            'headers' => $headers,
        ]);
    }
}
