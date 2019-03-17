<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     * @param ArticleRepository $articleRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function blog(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $articleRepository->findByArticle();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('blog/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/article/{slug}", name="show_article")
     * @param ArticleRepository $articleRepository
     * @param string $slug
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function article(ArticleRepository $articleRepository, string  $slug): Response
    {
        return $this->render('blog/show.html.twig', ['article' => $articleRepository->findBySLug($slug)]);
    }
}