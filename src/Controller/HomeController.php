<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository, EventRepository $eventRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBySixArticle(),
            'events' => $eventRepository->findBySixEvent()
        ]);
    }

}
