<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Calendar;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em)
    {
    }

    #[Route(path: '/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route(path: '/api/{id}/edit', name: 'api_event_edit', methods: ['PUT'])]
    public function majEvent(?Calendar $calendar, Request $request): Response
    {// Cognitive complexity for "App\Controller\ApiController::majEvent()" is 17, keep it under 9
        // On récupère les données
        $donnees = json_decode($request->getContent(), null, 512, JSON_THROW_ON_ERROR);

        if (// isset() is forbidden to use
            isset($donnees->title) && (null !== $donnees->title)
            && isset($donnees->start) && (null !== $donnees->start)
            && isset($donnees->description) && (null !== $donnees->description)
            && isset($donnees->backgroundColor) && (null !== $donnees->backgroundColor)
            && isset($donnees->borderColor) && (null !== $donnees->borderColor)
            && isset($donnees->textColor) && (null !== $donnees->textColor)
            && isset($donnees->allDay) && (null !== $donnees->allDay)
            && isset($donnees->end) && (null !== $donnees->end)
        ) {// Cannot access property $title on mixed.
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if (!$calendar instanceof Calendar) {
                // On instancie un rendez-vous
                $calendar = new Calendar();

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendar->setTitle($donnees->title);
            $calendar->setDescription($donnees->description);
            $calendar->setStart(new \DateTime($donnees->start));
            if ($donnees->allDay) {
                $calendar->setEnd(new \DateTime($donnees->start));
            } else {
                $calendar->setEnd(new \DateTime($donnees->end));
            }

            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);

            $entityManager = $this->em->getManager();
            $entityManager->persist($calendar);
            $entityManager->flush();

            // On retourne le code
            return new Response('Ok', $code);
        } else {
            // Les données sont incomplètes
            return new Response('Données incomplètes', Response::HTTP_NOT_FOUND);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]); // Unreachable statement - code above always terminates
    }
}
