<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

class MapController extends AbstractController
{
    // Route utilisée pour afficher la carte avec les événements et pour en ajouter
    #[Route("/map", name: "app_map", methods: ['GET', 'POST'])]
    public function index(Request $request, EventRepository $eventRepository, SluggerInterface $slugger): Response
    {
        //Création d'un nouvel événement par les utilisateurs
        $newEvent = new Event();
        $form = $this->createForm(EventType::class, $newEvent);
        $form->handleRequest($request);
        $user=$this->getUser();

        //Ajout d'un message flash pour les user qui n'ont pas confirmé leur mail
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->getUser()->isVerified()) {
            $this->addFlash('warning', 'Pour rappel, veuillez confirmer votre profil avec le lien reçu par mail pour profiter de toutes les fonctionnalités.');
        }

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Ajout de cette ligne pour générer le slug automatiquement
                $newEvent->setEventSlug(strtolower($slugger->slug($newEvent->getEventName())));
        
                //On récupère les informations de l'utilisateur pour le UserCreator
                $user=$this->getUser();

                // On associe le UserCreator à l'événement
                $newEvent->setCreator($user);

                //On enregistre dans la base de données
                $eventRepository->save($newEvent, true);
                $this->addFlash('success', 'L\'événement a été ajouté, vous pouvez aussi le retrouver dans votre profil.');
                //On redirige l'utilisateur vers la map
                return $this->redirectToRoute('app_map', [], Response::HTTP_SEE_OTHER);
            } else {
            $this->addFlash('error', 'Le formulaire contient des erreurs. Veuillez les corriger.');
        }
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
                'user' => $user,
            ]);
        }

    }

    // Route pour modifier un événement
    #[Route('/{id}/edit-event', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function editEvent(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        //Route possible que pour les user inscrits
        $this->denyAccessUnlessGranted('ROLE_USER');
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->save($event, true);
            $this->addFlash('success', 'L\'événement a été modifié.');
            return $this->redirectToRoute('app_map', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('map/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    //Route pour supprimer un événement
    #[Route('/{id}/delete-event', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        //Route possible que pour les user inscrits
        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $eventRepository->remove($event, true);
            $this->addFlash('success', 'L\'événement a été supprimé.');

        }
        return $this->redirectToRoute('app_map', [], Response::HTTP_SEE_OTHER);
    }

    }
