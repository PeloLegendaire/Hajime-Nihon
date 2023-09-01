<?php

namespace App\Repository;

use App\Entity\Signe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Signe>
 *
 * @method Signe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Signe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Signe[]    findAll()
 * @method Signe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SigneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Signe::class);
    }

    public function findByTypeOrdered(ServiceEntityRepository $repository) :array
    {
        $signes = [];
        $signes[Signe::TYPE_MONOGRAMME] = $repository->findBy(['type' => Signe::TYPE_MONOGRAMME]);
        $signes[Signe::TYPE_DIGRAMME] = $repository->findBy(['type' => Signe::TYPE_DIGRAMME]);
        $signes[Signe::TYPE_MONOGRAMME . '/' . Signe::TYPE_DIACRITIQUE] = $repository->findBy(['type' => Signe::TYPE_MONOGRAMME . '/' . Signe::TYPE_DIACRITIQUE]);
        $signes[Signe::TYPE_DIGRAMME . '/' . Signe::TYPE_DIACRITIQUE] = $repository->findBy(['type' => Signe::TYPE_DIGRAMME . '/' . Signe::TYPE_DIACRITIQUE]);
        return $signes;
    }


//    /**
//     * @return Signe[] Returns an array of Signe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Signe
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
