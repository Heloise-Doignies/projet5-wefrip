<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

class MapController extends AbstractController
{
    #[Route("/map", name: "app_map", methods: ['GET', 'POST'])]
    public function index(Request $request, EventRepository $eventRepository, SluggerInterface $slugger): Response
    {
        //Création d'un nouvel événement par les utilisateurs
        $newEvent = new Event();
        $form = $this->createForm(EventType::class, $newEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajout de cette ligne pour générer le slug automatiquement
            $newEvent->setEventSlug(strtolower($slugger->slug($newEvent->getEventName())));
        
            //On enregistre dans la base de données
            $eventRepository->save($newEvent, true);
            //On redirige l'utilisateur vers la map
            return $this->redirectToRoute('app_map', [], Response::HTTP_SEE_OTHER);
        }
        
        //Affichage des events (markers) déjà enregistrés
        $events = $eventRepository->findAll();

        //Création de la vue
        if ($form->isSubmitted()) {
            //Si le formulaire est soumis, afficher uniquement les événements enregistrés
            return $this->render('map/index.html.twig', [
                'events'=> $events,
                'form' => $form->createView(),
            ]);
        } else {
            //Sinon, on affiche le formulaire et les événements enregistrés
            return $this->render('map/index.html.twig', [
                'events'=> $events,
                'form' => $form->createView(),
                'newEvent' => $newEvent,
            ]);
        }

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
