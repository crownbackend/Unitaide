<?php

namespace App\Controller\Admin;

use App\Form\SendMailType;
use App\Repository\NewsletterRepository;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsletterAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class NewsletterAdminController extends AbstractController
{
    /**
     * @Route("/newsletter", name="admin_newsletter_send")
     * @param NewsletterRepository $newsletterRepository
     * @param MailerService $mailerService
     * @param \Swift_Mailer $mailer
     * @param Request $request
     * @return Response
     */
    public function sendEmail(NewsletterRepository $newsletterRepository, MailerService $mailerService, \Swift_Mailer $mailer, Request $request)
    {
        $email_tab = [];
        $emails = $newsletterRepository->findAll();
        foreach ($emails as  $email) {
            array_push($email_tab,$email->getEmail());
        }

        $form = $this->createForm(SendMailType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $mailerService->sendMail($mailer, $email_tab, 'unitaide@hotmail.com', $data['name'], $data['content']);
        }


        return $this->render('backOffice/newsletter/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}