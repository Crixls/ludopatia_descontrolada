<?php

namespace App\Repository;

use App\Entity\NumeroLoteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NumeroLoteria>
 *
 * @method NumeroLoteria|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumeroLoteria|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumeroLoteria[]    findAll()
 * @method NumeroLoteria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumeroLoteriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumeroLoteria::class);
    }

//    /**
//     * @return NumeroLoteria[] Returns an array of NumeroLoteria objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NumeroLoteria
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
