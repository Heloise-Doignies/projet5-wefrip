<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MapController extends AbstractController
{
    #[Route("/map", name: "app_map")]
    public function index(EventRepository $eventRepository): Response
    {
        //Affichage des events (markers) déjà enregistrés
        $events = $eventRepository->findAll();
        return $this->render('map/index.html.twig', [
            'events'=> $events,
        ]);
    }

    #[Route("/map_newEvent", name: "create_newEvent", methods: ['GET', 'POST'])]
    public function newEvent(Request $request, EventRepository $eventRepository): Response
    {
        //Création d'un nouvel événement par les utilisateurs
            $event = new Event();
            $form = $this->createForm(EventType::class, $event);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                //On enregistre dans la base de données
                $eventRepository->save($event, true);
                //On redirige l'utilisateur vers la map
                return $this->redirectToRoute('app_map', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('map/new.html.twig', [
                'event' => $event,
                'form' => $form,
            ]);
        }

    }
