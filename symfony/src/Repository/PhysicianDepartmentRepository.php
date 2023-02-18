<?php

namespace App\Repository;

use App\Entity\PhysicianDepartment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhysicianDepartment>
 *
 * @method PhysicianDepartment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicianDepartment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicianDepartment[]    findAll()
 * @method PhysicianDepartment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicianDepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicianDepartment::class);
    }

    public function save(PhysicianDepartment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PhysicianDepartment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PhysicianDepartment[] Returns an array of PhysicianDepartment objects
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

//    public function findOneBySomeField($value): ?PhysicianDepartment
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
