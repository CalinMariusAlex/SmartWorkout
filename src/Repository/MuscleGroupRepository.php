<?php

namespace App\Repository;

use App\Entity\MuscleGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MuscleGroup>
 */
class MuscleGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuscleGroup::class);
    }

    public function saveMuscleGroup(MuscleGroup $group): void
    {
        $this->getEntityManager()->persist($group);
        $this->getEntityManager()->flush();
    }

    public function removeMuscleGroup(int $ID): void
    {
        $toDelete = $this->getEntityManager()->getRepository(MuscleGroup::class)->find($ID);
        $this->getEntityManager()->remove($toDelete);
        $this->getEntityManager()->flush();
    }

    public function checkMuscleGroup(MuscleGroup $group): bool
    {
        return !!$this->getEntityManager()->getRepository(MuscleGroup::class)->findBy(['name' => $group->getName()]);
    }

    //    /**
    //     * @return MuscleGroup[] Returns an array of MuscleGroup objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MuscleGroup
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
