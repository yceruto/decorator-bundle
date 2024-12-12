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

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateMessengerHandler\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;
use Yceruto\DecoratorBundle\Tests\Integration\App\DecorateMessengerHandler\Message\Greeting;

#[AsController]
#[Route('/messenger/handler/greeting')]
readonly class DefaultController
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(): Response
    {
        $result = $this->messageBus->dispatch(new Greeting('World!'))
            ->last(HandledStamp::class)
            ->getResult()
        ;

        return new Response($result);
    }
}
