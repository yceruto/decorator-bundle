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

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Yceruto\DecoratorBundle\Tests\Integration\App\AppKernel;

class AbstractWebTestCase extends WebTestCase
{
    public static function setUpBeforeClass(): void
    {
        static::deleteTmpDir();
    }

    public static function tearDownAfterClass(): void
    {
        static::deleteTmpDir();
    }

    protected static function deleteTmpDir(): void
    {
        if (!file_exists($dir = sys_get_temp_dir().'/'.static::getVarDir())) {
            return;
        }

        $fs = new Filesystem();
        $fs->remove($dir);
    }

    protected static function getKernelClass(): string
    {
        require_once __DIR__.'/App/AppKernel.php';

        return AppKernel::class;
    }

    protected static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        if (!isset($options['test_case'])) {
            $options['test_case'] = static::getTestCase();
        }

        return parent::createClient($options, $server);
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        $class = self::getKernelClass();

        if (!isset($options['test_case'])) {
            $options['test_case'] = static::getTestCase();
        }

        return new $class(
            static::getVarDir(),
            $options['test_case'],
            $options['root_config'] ?? 'config.yaml',
            $options['environment'] ?? 'test',
            $options['debug'] ?? true,
        );
    }

    protected static function getVarDir(): string
    {
        return 'Decorator'.substr(strrchr(static::class, '\\'), 1);
    }

    protected static function getTestCase(): string
    {
        $parts = explode('\\', static::class);

        return substr(end($parts), 0, -4);
    }
}
