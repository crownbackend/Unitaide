<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class CategoryAdminController extends AbstractController
{
    /**
     * @Route("/categorie/", name="admin_list_category")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('backOffice/Category/index.html.twig', $articleRepository->findAll());
    }

    public function add(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->redirectToRoute('admin_list_category');
        }

        return $this->render('backOffice/Category/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}



