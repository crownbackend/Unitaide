<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $query = $articleRepository->findByArticle();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('backOffice/article/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/detail/{slug}", name="admin_show_article")
     * @param ArticleRepository $articleRepository
     * @param string $slug
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function Show(ArticleRepository $articleRepository, string $slug): Response
    {
        return $this->render('backOffice/article/show.html.twig', [
            'article' => $articleRepository->findBySlug($slug)
        ]);
    }

    /**
     * @Route("/ajouter-un-article", name="admin_new_article")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function add(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_list_article');
        }

        $category = new Category();
        $formCategory = $this->createForm(CategoryType::class, $category);
        $formCategory->handleRequest($request);

        if ($formCategory->isSubmitted() && $formCategory->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin_new_article');
        }

        return $this->render('backOffice/article/add-article.html.twig', [
            'form' => $form->createView(),
            'form_category' => $formCategory->createView()
        ]);
    }

    /**
     * @Route("/editer/{id}", name="admin_edit_article")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, int $id): Response
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
            $article->setUpdatedAt($date);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin_show_article', [
                'slug' => $article->getSlug()
            ]);
        }
        return $this->render('backOffice/article/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_delete_article")
     * @param ArticleRepository $articleRepository
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(ArticleRepository $articleRepository, int $id): RedirectResponse
    {
        $article = $articleRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        foreach ($article->getImages() as $image) {
            $article->removeImage($image);
        }
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('admin_list_article');
    }

}