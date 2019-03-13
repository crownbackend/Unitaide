<?php

namespace App\Tests\Repository;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindBySearch()
    {
        $search = $this->entityManager->getRepository(Article::class)->findBySearch('Interactively');
        $this->assertCount(1, $search);
    }

    public function testFindBySixArticle()
    {
        $search = $this->entityManager->getRepository(Article::class)->FindBySixArticle();
        $this->assertCount(2, $search);
    }

    public function testFindByThreeArticle()
    {
        $search = $this->entityManager->getRepository(Article::class)->findByThreeArticle();
        $this->assertCount(2, $search);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}