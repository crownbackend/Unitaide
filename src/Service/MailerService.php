<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerService extends AbstractController
{
    public function sendMail(\Swift_Mailer $mailer, $bbc, $from, $subject, $content)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setBcc($bbc)
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

    public function contact(\Swift_Mailer $mailer, $to, $from, $subject, $content)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $content,
                'text/plain'
            )
        ;
        $mailer->send($message);
    }

    public function confirmNewsletter(\Swift_Mailer $mailer, $to, $from, $subject, $name)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $this->renderView(
                    'emails/confirmation.html.twig',
                    [
                        'name' => $name
                    ]
                ),
                'text/html'
            );
        $mailer->send($message);
    }
}