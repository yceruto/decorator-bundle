<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Yceruto\DecoratorBundle\Decorator\Doctrine\ORM\Transactional;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set(Transactional::class)
            ->call('setManagerRegistry', [service('doctrine')])
            ->tag('decorator')
    ;
};
