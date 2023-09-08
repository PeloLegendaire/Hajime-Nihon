<?php

namespace App\Repository;

use App\Entity\Quiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quiz>
 *
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function getAllIds(string $tableName, string $type = null) {
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'SELECT id FROM ' . $tableName . ' t';
        if ($type !== null) {
            $sql .= ' WHERE type = ' . $type;
        }
        $result = $connection->executeQuery($sql);
        return $result->fetchAllAssociative();
    }

    public function getQuestion(int $id, string $tableName, string $type = null) {
        $connection = $this->getEntityManager()->getConnection();
        $column = ($type === null ? 'signe' : 'kanji');
        $sql = 'SELECT ' . $column . ', romaji FROM ' . $tableName . ' t';
        if ($type === null) {
            $sql .= ' INNER JOIN signe s ON t.id = s.id';
        }
        $sql .= ' WHERE t.id = ' . $id;
        $result = $connection->executeQuery($sql);
        return $result->fetchAssociative();
    }

//    /**
//     * @return Quiz[] Returns an array of Quiz objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Quiz
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
