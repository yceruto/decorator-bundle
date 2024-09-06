<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Yceruto\Decorator\CallableDecorator;
use Yceruto\Decorator\DecoratorInterface;
use Yceruto\Decorator\Resolver\DecoratorResolverInterface;
use Yceruto\DecoratorBundle\Controller\Listener\DecorateControllerListener;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('decorator.callable_decorator', CallableDecorator::class)
            ->args([
                service(DecoratorResolverInterface::class),
            ])

        ->alias(DecoratorInterface::class, 'decorator.callable_decorator')

        ->set(DecorateControllerListener::class)
            ->args([
                service('decorator.callable_decorator'),
            ])
            ->tag('kernel.event_subscriber')
    ;
};
