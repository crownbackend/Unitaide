<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @Route("/qui-sommes-nous", name="about")
     */
    public function about()
    {
        return $this->render('about/index.html.twig');
    }
}
