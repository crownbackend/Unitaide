<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function index(): Response
    {
        return $this->render('backOffice/home/index.html.twig');
    }

    /**
     * @Route("/add-article", name="new_article")
     * @param Request $request
     * @return Response
     */
    public function addArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->render('backOffice/home/index.html.twig');
        }

        return $this->render('backOffice/home/add-article.html.twig', [
            'form' => $form->createView()
        ]);
    }
}



