<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/evenements", name="event")
     * @param EventRepository $eventRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function event(EventRepository $eventRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $eventRepository->findByEvent();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('event/index.html.twig', [
            'pagination' => $pagination
        ]);
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