<?php

namespace App\Controller\Admin;

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
}