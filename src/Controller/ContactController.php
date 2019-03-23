<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param MailerService $mailerService
     * @return Response
     */

    public function contact(Request $request, \Swift_Mailer $mailer, MailerService $mailerService): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $mailerService->contact($mailer, 'contact@unitaide.org', $data['email'], $data['name'], $data['content']);

            $this->addFlash('mail_send_success', 'Email envoyer avec sucés !');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}