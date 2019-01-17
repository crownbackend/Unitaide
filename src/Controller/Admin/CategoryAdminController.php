<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('backOffice/Category/index.html.twig', ['categories' => $categoryRepository->findAll()]);
    }

    /**
     * @Route("/ajouter-categorie", name="admin_new_category")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('admin_list_category');
        }

        return $this->render('backOffice/Category/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorie/editer/{id}", name="admin_edit_category")
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, int $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_list_category');
        }

        return $this->render('backOffice/Category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/supprimer/{id}", name="admin_delete_category")
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('admin_list_category');
    }
}



