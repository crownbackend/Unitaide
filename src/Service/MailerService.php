<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerService extends AbstractController
{
    public function sendMail(\Swift_Mailer $mailer, $to, $from, $subject, $content)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setBcc($to)
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['content' => $content]
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    }
}