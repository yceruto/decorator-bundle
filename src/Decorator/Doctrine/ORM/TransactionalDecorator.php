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

namespace Yceruto\DecoratorBundle\Decorator\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Yceruto\Decorator\DecoratorInterface;

final readonly class TransactionalDecorator implements DecoratorInterface
{
    public function __construct(
        private ManagerRegistry $managerRegistry,
    ) {
    }

    public function decorate(\Closure $func, Transactional $transactional = new Transactional()): \Closure
    {
        $entityManager = $this->managerRegistry->getManager($transactional->name);

        if (!$entityManager instanceof EntityManagerInterface) {
            throw new \RuntimeException(\sprintf('The manager "%s" is not an entity manager.', $transactional->name));
        }

        return static function (mixed ...$args) use ($func, $entityManager) {
            $entityManager->getConnection()->beginTransaction();

            try {
                $return = $func(...$args);

                $entityManager->flush();
                $entityManager->getConnection()->commit();

                return $return;
            } catch (\Throwable $e) {
                $entityManager->close();
                $entityManager->getConnection()->rollBack();

                throw $e;
            }
        };
    }
}
