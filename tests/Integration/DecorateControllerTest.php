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

class DecorateControllerTest extends AbstractWebTestCase
{
    public function testNoDecorator(): void
    {
        $client = self::createClient();
        $client->request('GET', '/no-decorator');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('html');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'text/html; charset=UTF-8');
        self::assertSame('OK', $client->getInternalResponse()->getContent());
    }

    public function testSerializerDecoratorDefaultOptions(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/default-options');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'application/json');
        self::assertSame('{"success":true}', $client->getInternalResponse()->getContent());
    }

    public function testSerializerDecoratorInInvokable(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/invokable');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'application/json');
        self::assertSame('{"success":true}', $client->getInternalResponse()->getContent());
    }

    public function testSerializerDecoratorEmptyResult(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/empty-result');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(204);
        self::assertSame('', $client->getInternalResponse()->getContent());
    }

    public function testSerializerDecoratorIgnoredWhenRedirectResponse(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/ignored-when-redirect-response');

        self::assertResponseStatusCodeSame(302);
        self::assertResponseRedirects('https://localhost');
    }

    public function testSerializerDecoratorCustomOptions(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/custom-options');

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('xml');
        self::assertResponseStatusCodeSame(201);
        self::assertResponseHeaderSame('Content-Type', 'application/xml');
        self::assertResponseHeaderSame('X-Foo', 'bar');
        self::assertSame('<?xml version="1.0"?><response><success>1</success></response>', str_replace("\n", '', $client->getInternalResponse()->getContent()));
    }

    public function testSerializerDecoratorUnsupportedFormat(): void
    {
        $client = self::createClient();
        $client->request('GET', '/serialize-decorator/unsupported-format');

        self::assertResponseFormatSame('html');
        self::assertResponseStatusCodeSame(500);
        self::assertResponseHeaderSame('Content-Type', 'text/html; charset=UTF-8');
        self::assertStringContainsString('Format &quot;xxx&quot; is not supported.', $client->getInternalResponse()->getContent());
    }

    public function testSecuritySerializerDecoratorsWithInvalidRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/security-serialize-decorators/default-options');

        self::assertResponseStatusCodeSame(401);
        self::assertSame('Invalid credentials provided.', $client->getInternalResponse()->getContent());
    }

    public function testSecuritySerializerDecoratorsWithValidRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/security-serialize-decorators/default-options', server: [
            'HTTP_X_API_KEY' => 'xyz',
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'application/json');
        self::assertSame('{"success":true}', $client->getInternalResponse()->getContent());
    }

    public function testCompoundDecoratorsWithValidRequest(): void
    {
        $client = self::createClient();
        $client->request('GET', '/compound-decorators/default-options', server: [
            'HTTP_X_API_KEY' => 'xyz',
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertResponseStatusCodeSame(200);
        self::assertResponseHeaderSame('Content-Type', 'application/json');
        self::assertSame('{"success":true}', $client->getInternalResponse()->getContent());
    }
}
