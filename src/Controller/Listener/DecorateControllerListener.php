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

namespace Yceruto\DecoratorBundle\Controller\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Yceruto\Decorator\DecoratorInterface;

class DecorateControllerListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly DecoratorInterface $decorator,
    ) {
    }

    public function __invoke(ControllerArgumentsEvent $event): void
    {
        $event->setController($this->decorator->decorate($event->getController()(...)));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => ['__invoke', -1024],
        ];
    }
}
