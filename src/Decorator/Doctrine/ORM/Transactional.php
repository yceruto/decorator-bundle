<?php

namespace Yceruto\DecoratorBundle\Decorator\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Yceruto\Decorator\Attribute\Decorate;
use Yceruto\Decorator\DecoratorInterface;

/**
 * Wraps persistence method operations within a single Doctrine transaction.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class Transactional extends Decorate implements DecoratorInterface
{
    private ManagerRegistry $managerRegistry;

    /**
     * @param string|null $name The entity manager name (null for the default one)
     */
    public function __construct(?string $name = null)
    {
        parent::__construct(self::class, ['name' => $name]);
    }

    public function decorate(\Closure $func, ?string $name = null): \Closure
    {
        $entityManager = $this->managerRegistry->getManager($name);

        if (!$entityManager instanceof EntityManagerInterface) {
            throw new \RuntimeException(\sprintf('The manager "%s" is not an entity manager.', $name));
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

    public function setManagerRegistry(ManagerRegistry $managerRegistry): void
    {
        $this->managerRegistry = $managerRegistry;
    }
}
