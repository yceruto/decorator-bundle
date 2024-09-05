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

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Yceruto\DecoratorBundle\DecoratorBundle;

return [
    new FrameworkBundle(),
    new DoctrineBundle(),
    new DecoratorBundle(),
    new class extends Bundle
    {
        public function shutdown(): void
        {
            restore_exception_handler();
        }
    }
];
