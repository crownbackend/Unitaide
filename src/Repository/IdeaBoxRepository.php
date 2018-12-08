<?php

namespace App\Repository;

use App\Entity\IdeaBox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IdeaBox|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdeaBox|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdeaBox[]    findAll()
 * @method IdeaBox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaBoxRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IdeaBox::class);
    }

    // /**
    //  * @return IdeaBox[] Returns an array of IdeaBox objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IdeaBox
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
