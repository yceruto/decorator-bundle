<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Yceruto\DecoratorBundle\Decorator\Doctrine\ORM\TransactionalDecorator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set(TransactionalDecorator::class)
            ->args([
                service('doctrine'),
            ])
            ->tag('decorator');
};
