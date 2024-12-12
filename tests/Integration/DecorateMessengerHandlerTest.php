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

namespace Yceruto\DecoratorBundle\Tests\Integration;

class DecorateMessengerHandlerTest extends AbstractWebTestCase
{
    public function testDecorator(): void
    {
        $client = self::createClient();
        $client->request('GET', '/messenger/handler/greeting');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('html');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'text/html; charset=UTF-8');
        self::assertSame('hello world!', $client->getInternalResponse()->getContent());
    }
}
