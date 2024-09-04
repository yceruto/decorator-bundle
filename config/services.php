<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Yceruto\Decorator\DecoratorChain;
use Yceruto\Decorator\DecoratorInterface;
use Yceruto\DecoratorBundle\Controller\Listener\DecorateControllerListener;

use function Symfony\Component\DependencyInjection\Loader\Configurator\abstract_arg;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('decorator.chain', DecoratorChain::class)
            ->args([
                abstract_arg('decorators locator, set in DecoratorsPass'),
            ])

        ->set('decorator.listener.controller', DecorateControllerListener::class)
            ->args([
                service('decorator.chain'),
            ])
            ->tag('kernel.event_subscriber')

        ->alias(DecoratorInterface::class, 'decorator.chain')
    ;
};
