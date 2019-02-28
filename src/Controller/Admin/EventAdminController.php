<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('backOffice/Event/index.html.twig');
    }

    /**
     * @Route("/ajouter-un-evenement", name="admin_new_event")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
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
}