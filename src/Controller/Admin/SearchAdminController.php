<?php

namespace App\Controller\Admin;

use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchAdminController extends AbstractController
{
    /**
     * @Route("/admin/result-article", name="admin_search_article")
     * @param Request $request
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function searchArticle(Request $request, ArticleRepository $articleRepository): Response
    {
        $search = $request->get('search-article');

        $result = $articleRepository->findBySearch($search);

        return $this->render('backOffice/search/article.html.twig', [
            'articles' => $result
        ]);
    }

    /**
     * @Route("/admin/result-event", name="admin_search_event")
     * @param Request $request
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function searchEvent(Request $request, EventRepository $eventRepository): Response
    {
        $event = $request->get('search-event');
        $result = $eventRepository->findBySearch($event);

        return $this->render('backOffice/search/event.html.twig', [
            'events' => $result
        ]);
    }
}