<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Yceruto\DecoratorBundle\Decorator\Serializer\SerializeDecorator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set(SerializeDecorator::class)
            ->args([
                service('serializer'),
                service('mime_types'),
            ])
            ->tag('decorator');
};
