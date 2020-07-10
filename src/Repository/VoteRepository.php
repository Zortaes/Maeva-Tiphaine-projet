<?php

namespace App\Repository;

use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vote[]    findAll()
 * @method Vote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vote::class);
    }


    /**
    * @return Article[] list of article by best vote, limit 6
    */
    public function findBestArticle()
    {

        /********
        SQL query
        *********/
        $rawSql = "
        SELECT A.title, A.summary, A.slug, A.image, U.username, U.slug user_slug, U.avatar AS user_avatar, C.name AS category_name, C.picture AS category_picture, AVG(V.vote_value) moyen 
        FROM article_category AC, article A, category C, vote V, user U
        WHERE AC.article_id = A.id
        AND AC.category_id = C.id
        AND V.article_id = A.id
        AND A.user_id = U.id
        GROUP BY AC.article_id, AC.category_id
        ORDER BY moyen DESC
        LIMIT 6";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute([]);

        return $stmt->fetchAll();

        /********
        DQL query
        *********/
        
        /*$qb = $this->createQueryBuilder('v')
        ->select('a.title, a.summary, a.slug, u.username, u.slug user_slug, u.avatar user_avatar, c.name category_name, c.color category_color, c.picture category_picture, avg(v.vote_value)moyen')
        ->innerJoin('App\Entity\Article', 'a', 'WITH', 'a = v.article')
        ->innerJoin('App\Entity\Category', 'c', 'WITH', 'c = a.category')
        ->innerJoin('App\Entity\User', 'u', 'WITH', 'u = a.user')
        ->groupBy('v.article')
        ->orderBy('moyen', 'DESC')
        ->setMaxResults(6) 
        ->getQuery()
        ->getResult();
        
        return $qb; */
    }


    // /**
    //  * @return Vote[] Returns an array of Vote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vote
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
