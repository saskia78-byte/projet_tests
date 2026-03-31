<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EventController extends AbstractController
{
    #[Route('/events', name: 'app_events')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        $eventsVisibles = [];

        foreach ($events as $event) {
            if ($event->isVisible() === true) {
                $eventsVisibles[] = $event;
            }
        }

        return $this->render('event/index.html.twig', [
            'events' => $eventsVisibles,
        ]);
    }
}