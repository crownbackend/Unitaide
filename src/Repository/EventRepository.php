<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findBySLug(string $slug)
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery();
        return $query->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function findBySixEvent()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.createdAt', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByThreeEvent()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findBySearch($search)
    { //SELECT * FROM `article` WHERE title LIKE "%keep%"
        $query = $this->createQueryBuilder('e')
            ->where('e.title LIKE :name')
            ->orWhere('e.description LIKE :name')
            ->setParameter('name', "%$search%")
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }
}
