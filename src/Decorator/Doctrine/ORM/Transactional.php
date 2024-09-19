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

namespace Yceruto\DecoratorBundle\Decorator\Doctrine\ORM;

use Yceruto\Decorator\Attribute\DecoratorAttribute;

/**
 * Wraps persistence method operations within a single Doctrine transaction.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class Transactional extends DecoratorAttribute
{
    /**
     * @param string|null $name The entity manager name (null for the default one)
     */
    public function __construct(
        public readonly ?string $name = null,
    ) {
    }
}
