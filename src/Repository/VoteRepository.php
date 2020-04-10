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
        $qb = $this->createQueryBuilder('v')
        ->select('a.title, a.summary, a.slug, u.username, c.name category_name, c.color category_color, c.picture category_picture, avg(v.vote_value)moyen')
        ->innerJoin('App\Entity\Article', 'a', 'WITH', 'a = v.article')
        ->innerJoin('App\Entity\Category', 'c', 'WITH', 'c = a.category')
        ->innerJoin('App\Entity\User', 'u', 'WITH', 'u = a.user')
        ->groupBy('v.article')
        ->orderBy('moyen', 'DESC')
        ->setMaxResults(6) 
        ->getQuery()
        ->getResult();
        
        return $qb; 
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
