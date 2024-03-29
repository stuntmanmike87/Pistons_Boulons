<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route(path: '/', name: 'main')]
    public function index(CalendarRepository $calendar): Response
    {
        $events = $calendar->findAll();

        $rdvs = [];

        $event = new Calendar();
        /** @var \DateTimeInterface $start */
        $start = $event->getStart();
        /** @var \DateTimeInterface $end */
        $end = $event->getEnd();

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $start->format('Y-m-d H:i:s'), // $event->getStart()
                'end' => $end->format('Y-m-d H:i:s'), // $event->getEnd()
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs, JSON_THROW_ON_ERROR);

        return $this->render('main/index.html.twig', ['data' => $data]);
    }
}
