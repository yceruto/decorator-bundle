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

namespace Yceruto\DecoratorBundle\Tests\Integration\App\DecorateMessengerHandler\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Yceruto\DecoratorBundle\Tests\Integration\App\DecorateMessengerHandler\Message\Greeting;
use Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator\FormatGreeting;

#[AsMessageHandler]
class GreetingHandler
{
    #[FormatGreeting('Casual')]
    public function __invoke(Greeting $greeting): string
    {
        return "Hello $greeting->name";
    }
}
