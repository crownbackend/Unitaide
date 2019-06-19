<?php

namespace App\Controller;

use App\Entity\IdeaBox;
use App\Form\IdeaBoxType;
use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ArticleRepository $articleRepository
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository, EventRepository $eventRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBySixArticle(),
            'events' => $eventRepository->findBySixEvent()
        ]);
    }

    /**
     * @Route("/une-idee-a-nous-paratger", name="idea_box")
     * @param Request $request
     * @return Response
     */
    public function newIdea(Request $request): Response
    {
        $idea = new IdeaBox();

        $form = $this->createForm(IdeaBoxType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idea);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('ideabox/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/faite-un-don", name="don")
     * @return Response
     */
    public function don(): Response
    {
        return $this->render('inc/don.html.twig');
    }

}
