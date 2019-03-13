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
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function event(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    /**
     * @Route("/evenements/{slug}", name="show_event")
     * @param EventRepository $eventRepository
     * @param string $slug
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function show(EventRepository $eventRepository, string $slug): Response
    {
        return $this->render('event/show.html.twig', ['event' => $eventRepository->findBySLug($slug)]);
    }
}