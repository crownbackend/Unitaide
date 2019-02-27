<?php

namespace App\Controller\Admin;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchAdminController extends AbstractController
{
    /**
     * @Route("/admin/result", name="admin_search")
     * @param Request $request
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function search(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = $request->get('search');

        $result = $articleRepository->findBySearch($article);

        return $this->render('backOffice/search/search.html.twig', [
            'articles' => $result
        ]);
    }
}