<?php

namespace App\Repository;

use App\Entity\Lexique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mot>
 *
 * @method Lexique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lexique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lexique[]    findAll()
 * @method Lexique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LexiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lexique::class);
    }

//    /**
//     * @return Mot[] Returns an array of Mot objects
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

//    public function findOneBySomeField($value): ?Mot
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
