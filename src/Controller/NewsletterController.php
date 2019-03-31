<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Service\MailerService;
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
     * @param MailerService $mailerService
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function addMail(Request $request, MailerService $mailerService, \Swift_Mailer $mailer): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            $to = $newsletter->getEmail();
            $name = $newsletter->getName();
            $from = 'contact@unitaide.org';
            $subject = 'Votre inscription à bien étais pris en compte';

            $mailerService->confirmNewsletter($mailer, $to, $from, $subject, $name);

            $this->addFlash('message', 'Votre inscription à bien étais pris en compte');
            return $this->redirectToRoute('home');
        }
        return $this->render('newsletter/newsletter.html.twig', [
            'form' => $form->createView()
        ]);
    }
}