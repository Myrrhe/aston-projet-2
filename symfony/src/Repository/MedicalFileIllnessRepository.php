<?php

namespace App\Repository;

use App\Entity\MedicalFileIllness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MedicalFileIllness>
 *
 * @method MedicalFileIllness|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalFileIllness|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalFileIllness[]    findAll()
 * @method MedicalFileIllness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalFileIllnessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalFileIllness::class);
    }

    public function save(MedicalFileIllness $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MedicalFileIllness $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MedicalFileIllness[] Returns an array of MedicalFileIllness objects
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

//    public function findOneBySomeField($value): ?MedicalFileIllness
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
