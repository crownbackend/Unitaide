<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsletterController
 * @package App\Controller
 */
class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter-register", name="newsletter")
     * @param Request $request
     * @return Response
     */
    public function newsletterSend(Request $request)
    {
        $user = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Votre inscription à bien étais pris en compte ');

            return $this->redirectToRoute('home');
        }

        return $this->render('newsletter/newsletter.html.twig', [
            'form' => $form->createView()
        ]);
    }
}