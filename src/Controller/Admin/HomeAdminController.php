<?php

namespace App\Controller\Admin;

use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class HomeAdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository, EventRepository $eventRepository): Response
    {
        return $this->render('backOffice/home/index.html.twig', [
            'articles' => $articleRepository->findByThreeArticle(),
            'events' => $eventRepository->findByThreeEvent()
        ]);
    }

}



