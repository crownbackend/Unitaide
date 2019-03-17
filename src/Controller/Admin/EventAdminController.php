<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EventAdminController
 * @package App\Controller\Admin
 * @Route("/admin/events")
 */
class EventAdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_list_event")
     * @param EventRepository $eventRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(EventRepository $eventRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $eventRepository->findByEvent();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('backOffice/Event/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/show/{slug}", name="admin_show_event")
     * @param EventRepository $eventRepository
     * @param string $slug
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function show(EventRepository $eventRepository, string $slug): Response
    {
        return $this->render('backOffice/Event/show.html.twig', [
            'event' => $eventRepository->findBySLug($slug)
        ]);
    }

    /**
     * @Route("/ajouter-un-evenement", name="admin_new_event")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function add(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('admin_list_event');
        }

        return $this->render('backOffice/Event/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/editer/{id}", name="admin_edit_event")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id): Response
    {
        $event = $this->getDoctrine()->getRepository(Event::class)->find($id);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_list_event');
        }

        return $this->render('backOffice/Event/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_delete_event")
     * @param EventRepository $eventRepository
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(EventRepository $eventRepository, int $id): RedirectResponse
    {
        $event = $eventRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        foreach ($event->getImages() as $image) {
            $event->removeImage($image);
        }
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('admin_list_event');
    }
}