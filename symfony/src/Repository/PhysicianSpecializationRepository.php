<?php

namespace App\Repository;

use App\Entity\PhysicianSpecialization;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhysicianSpecialization>
 *
 * @method PhysicianSpecialization|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicianSpecialization|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicianSpecialization[]    findAll()
 * @method PhysicianSpecialization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicianSpecializationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicianSpecialization::class);
    }

    public function save(PhysicianSpecialization $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PhysicianSpecialization $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PhysicianSpecialization[] Returns an array of PhysicianSpecialization objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PhysicianSpecialization
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
