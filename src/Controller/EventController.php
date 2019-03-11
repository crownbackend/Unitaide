<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/evenements", name="event")
     */
    public function event(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }
}