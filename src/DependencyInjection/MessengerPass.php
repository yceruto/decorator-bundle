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

namespace Yceruto\DecoratorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Yceruto\DecoratorBundle\Messenger\Middleware\HandleMessageMiddleware;

class MessengerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('messenger.middleware.handle_message')) {
            return;
        }

        $middlewareDef = $container->getDefinition('messenger.middleware.handle_message');
        $middlewareDef->setClass(HandleMessageMiddleware::class);
        $middlewareDef->setAutowired(true);
    }
}
