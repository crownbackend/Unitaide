<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleAdminController
 * @package App\Controller\Admin
 * @Route("/admin/article")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_list_article")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function indexArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('backOffice/article/index.html.twig', ['articles' => $articleRepository->findAll()]);
    }


    /**
     * @Route("/ajouter-un-article", name="admin_new_article")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function addArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('backOffice/article/add-article.html.twig', [
            'form' => $form->createView()
        ]);
    }

}