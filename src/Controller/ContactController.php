<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * ContactController constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact/index.html.twig');
    }

    /**
     * @Route("/newsletter", name="newsletter")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function newsletter(Request $request, \Swift_Mailer $mailer): Response
    {
        $user = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->registry->getManager();
            $manager->persist($user);
            $manager->flush();

           /* $message = (new \Swift_Message('Unitaide.org inscription prise en compte'))
            ->setFrom('newsletter@untiaide.org')
            ->setTo()
            ;*/

            $this->addFlash('message', 'Votre inscription à bien été prise en compte');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/newsletter.html.twig', [
            'form' => $form->createView()
        ]);
    }
}