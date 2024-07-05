<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exercise>
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    public function saveExercise(Exercise $exercise):void
    {
        $this->getEntityManager()->persist($exercise);
        $this->getEntityManager()->flush();
    }

    public function deleteExercise(Exercise $exercise)
    {
        $this->getEntityManager()->remove($exercise);
        $this->getEntityManager()->flush();
    }

        /**
         * @return Exercise[] Returns an array of Exercise objects
         */
        public function checkExerciseExists($name, $id): array
        {
            return $this->createQueryBuilder('e')
                ->andWhere('e.name = :val')
                ->setParameter('val', $name)
                ->andWhere('e.id != :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult()
            ;
        }

    public function checkExerciseExistsByName($name): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.name = :val')
            ->setParameter('val', $name)
            ->getQuery()
            ->getResult()
            ;
    }

    //    public function findOneBySomeField($value): ?Exercise
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
