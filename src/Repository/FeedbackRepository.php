<?php

namespace App\Repository;

use App\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Feedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feedback[]    findAll()
 * @method Feedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feedback::class);
    }

        /**
    * @return Feedback[] list of last feedback flagged
    */
    public function findByFlaggedFeedback($flag) 
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.flaggedUp = :val')
            ->setParameter('val', $flag)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByDate($article_id) 
    {
        $qb = $this->createQueryBuilder('f')
        ->select('f.id, f.comment, f.created_at, f.flaggedUp, u.username, u.avatar user_avatar ')
        ->andWhere('f.article = :val')
        ->innerJoin('App\Entity\Article', 'a', 'WITH', 'a = f.article')
        ->innerJoin('App\Entity\User', 'u', 'WITH', 'u = f.user')
        ->setParameter('val', $article_id)
        ->orderBy('f.created_at', 'DESC')
        ->getQuery()
        ->getResult();
        
        return $qb;
    }

    // /**
    //  * @return Feedback[] Returns an array of Feedback objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Feedback
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
