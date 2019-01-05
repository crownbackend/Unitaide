<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @return string
     */
    private function    generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/add-article", name="new_article")
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

            $files = $article->getImages();

            foreach ($files as $file) {
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render('backOffice/home/add-article.html.twig', [
            'form' => $form->createView()
        ]);
    }
}