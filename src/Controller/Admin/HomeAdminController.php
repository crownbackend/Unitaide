<?php

namespace App\Controller\Admin;

use App\Entity\IdeaBox;
use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use App\Repository\IdeaBoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/idea-box", name="admin_idea_box_list")
     * @param IdeaBoxRepository $ideaBoxRepository
     * @return Response
     */
    public function ideaBox(IdeaBoxRepository $ideaBoxRepository): Response
    {
        return $this->render('backOffice/ideabox/show.html.twig', [
            'ideabox' => $ideaBoxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/idea-box/show/{id}", name="admin_idea_box_show")
     * @param IdeaBox $ideaBox
     * @param Request $request
     * @return JsonResponse
     */
    public function showIdea(IdeaBox $ideaBox, Request $request): JsonResponse
    {
        if ($request->isXmlHttpRequest()) {
            return $this->json($ideaBox);
        }
        return new JsonResponse(['errors' => 'not found']);
    }

}



