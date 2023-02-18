<?php

namespace App\Repository;

use App\Entity\PharmacyMedication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PharmacyMedication>
 *
 * @method PharmacyMedication|null find($id, $lockMode = null, $lockVersion = null)
 * @method PharmacyMedication|null findOneBy(array $criteria, array $orderBy = null)
 * @method PharmacyMedication[]    findAll()
 * @method PharmacyMedication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PharmacyMedicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PharmacyMedication::class);
    }

    public function save(PharmacyMedication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PharmacyMedication $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PharmacyMedication[] Returns an array of PharmacyMedication objects
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

//    public function findOneBySomeField($value): ?PharmacyMedication
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
