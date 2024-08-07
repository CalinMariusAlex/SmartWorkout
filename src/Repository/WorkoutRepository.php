<?php

namespace App\Repository;

use App\Entity\Workout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Workout>
 */
class WorkoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workout::class);
    }

    public function saveWorkout(Workout $workout): void
    {
        $this->getEntityManager()->persist($workout);
        $this->getEntityManager()->flush();
    }

    public function getAllWorkouts(): array
    {
        return $this->findAll();
    }

    public function deleteWorkout(Workout $workout)
    {
        $this->getEntityManager()->remove($workout);
        $this->getEntityManager()->flush();
    }

        /**
         * @return Workout[] Returns an array of Workout objects
         */
        public function findByUserField($user): array
        {
            return $this->createQueryBuilder('w')
                ->andWhere('w.person = :val')
                ->setParameter('val', $user)
                ->getQuery()
                ->getResult()
            ;
        }

    public function findByIdField($id): ?Workout
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

//
//        public function findOneByUserField($user): ?Workout
//        {
//            return $this->createQueryBuilder('w')
//                ->andWhere('w.person = :val')
//                ->setParameter('val', $user)
//                ->getQuery()
//                ->getOneOrNullResult()
//            ;
//        }
}
