<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function findBySlug(string $slug)
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
    public function findByThreeArticle()
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
    public function findBySixArticle()
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
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.title LIKE :name')
            ->orWhere('a.description LIKE :name')
            ->setParameter('name', "%$search%")
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }

    public function findBySearchAjax($search)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.title LIKE :name')
            ->orWhere('a.description LIKE :name')
            ->setParameter('name', "%$search%")
            ->getQuery()
            ->getArrayResult()
        ;
        return $query;
    }

    public function findByArticle()
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }

}
