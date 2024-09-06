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

use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Yceruto\Decorator\Resolver\DecoratorResolver;
use Yceruto\Decorator\Resolver\DecoratorResolverInterface;

class DecoratorsPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        $tagName = new TaggedIteratorArgument('decorator', needsIndexes: true);
        $decorators = $this->findAndSortTaggedServices($tagName, $container);

        $resolver = (new Definition(DecoratorResolver::class))
            ->addArgument(ServiceLocatorTagPass::map($decorators))
            ->addTag('container.service_locator');

        $id = '.service_locator.'.ContainerBuilder::hash($resolver);
        $container->setDefinition($id, $resolver);

        $container->setAlias(DecoratorResolverInterface::class, $id);
    }
}
