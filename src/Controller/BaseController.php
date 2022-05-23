<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/service/{vueRouting}", name="service")
     */
    public function service(): Response
    {
        return $this->render('service.html.twig');
    }

    /**
     * @Route("/service", name="service")
     */
    public function serviceXd(): Response
    {
        return $this->redirectToRoute('service', ['wildcard' =>'']);
    }

    /**
     * @Route("/{vueRouting}", name="main")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/xd", name="main")
     */
    public function xd(): Response
    {
        return $this->render('base.html.twig');
    }
}
