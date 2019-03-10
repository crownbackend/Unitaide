<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findBySLug(string $slug)
    {
        $query = $this->createQueryBuilder('a')
                ->where('a.slug = :slug')
                ->setParameter('slug', $slug)
                ->getQuery();
        return $query->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function findThreeArticle()
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }

    /**
     * @return mixed
     */
    public function findSixArticle()
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }

    public function findBySearch($search)
    { //SELECT * FROM `article` WHERE title LIKE "%keep%"
        $query = $this->createQueryBuilder('a')
            ->where('a.title LIKE :name')
            ->orWhere('a.description LIKE :name')
            ->setParameter('name', "%$search%")
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }

}
