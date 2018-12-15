<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter", name="newsletter")
     * @param Request $request
     * @return Response
     */
    public function newsletter(Request $request): Response
    {
        $user = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('message', 'Votre inscription à bien été prise en compte');
            return $this->redirectToRoute('home');
        }

        return $this->render('inc/footer.html.twig', [
            'formNews' => $form->createView()
        ]);
    }
}