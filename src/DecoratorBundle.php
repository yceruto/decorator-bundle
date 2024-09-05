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

namespace Yceruto\DecoratorBundle;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\Serializer\SerializerInterface;
use Yceruto\Decorator\DecoratorInterface;
use Yceruto\DecoratorBundle\DependencyInjection\DecoratorsPass;

class DecoratorBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new DecoratorsPass());
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->registerForAutoconfiguration(DecoratorInterface::class)
            ->addTag('decorator');

        $container->import('../config/services.php');

        if (interface_exists(EntityManagerInterface::class)) {
            $container->import('../config/doctrine.php');
        }

        if (interface_exists(SerializerInterface::class)) {
            $container->import('../config/serializer.php');
        }
    }
}
