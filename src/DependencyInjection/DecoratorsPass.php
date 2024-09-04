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

use Symfony\Component\DependencyInjection\Argument\ServiceLocatorArgument;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DecoratorsPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('decorator.chain')) {
            return;
        }

        $tagName = new TaggedIteratorArgument('decorator', needsIndexes: true);
        $decorators = $this->findAndSortTaggedServices($tagName, $container);

        $decoratorChain = $container->getDefinition('decorator.chain');
        $decoratorChain->replaceArgument(0, new ServiceLocatorArgument($decorators));
    }
}
