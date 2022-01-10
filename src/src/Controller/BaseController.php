<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/{vueRouting}", name="main")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
    /**
     * @Route("/service/{vueRouting}", name="service")
     */
    public function service(): Response
    {
        return $this->render('service.html.twig');
    }
    /**
     * @Route("/xd", name="main")
     */
    public function xd(): Response
    {
        return $this->render('base.html.twig');
    }
}
