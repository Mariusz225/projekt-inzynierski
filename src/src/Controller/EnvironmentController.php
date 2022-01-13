<?php

namespace App\Controller;

use App\Entity\Status;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnvironmentController extends AbstractController
{
    /**
     * @Route("/environment", name="environment")
     */
    public function index(
        EntityManagerInterface $entityManager
    ): Response
    {
        $statusCart = new Status();
        $statusCart->setName('cart');

        $statusOrdered = new Status();
        $statusOrdered->setName('ordered');

        $statusCompleted = new Status();
        $statusCompleted->setName('completed');

        $statusWaitingForDelivery = new Status();
        $statusWaitingForDelivery->setName('waitingForDelivery');

        $entityManager->persist($statusCart);
        $entityManager->persist($statusOrdered);
        $entityManager->persist($statusCompleted);
        $entityManager->persist($statusWaitingForDelivery);
        $entityManager->flush();

        return new JsonResponse('true');
    }
}
