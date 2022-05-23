<?php

namespace App\Controller;

//use App\Entity\DateAvailability;
//use App\Entity\DateAvailability;
use App\Repository\DateAvailabilityRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Rest\Route("/start", name="start.")
 */
class StartController extends AbstractController
{
    /**
     * @Rest\Get("/")
     */
    public function start(
        DateAvailabilityRepository $dateAvailabilityRepository,
//        DateAvailability $dateAvailability,
        EntityManagerInterface $entityManager
    )
    {
        $availabilityDates = $dateAvailabilityRepository->findAll();
        foreach ($availabilityDates as $availabilityDate) {
//            dd($availabilityDate);
//            $availabilityDate->setQuantity(0);
            if ($availabilityDate->getQuantity() > 0) {
                $date = Carbon::createFromDate($availabilityDate->getDate());
                if ($date->isPast()) {
                    $availabilityDate->setQuantity(0);
                }

                $entityManager->persist($availabilityDate);
                $entityManager->flush();
            }

        }
//        dd($dates);
//        return new JsonResponse($dates);
//        return $this->redirect('http://localhost:8000');
    }
}