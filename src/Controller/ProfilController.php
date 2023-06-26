<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\UserType;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\TutorialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        //On récupère les informations du profil de l'utilisateur
        $user = $this->getUser();

        // on crée un formulaire avec les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // on vérifie si l'utilisateur a changé de mdp
            if (!is_null($request->request->get('password'))) {
                // on encode le nouveau mdp et on l'affecte au user
                $password = $encoder->hashPassword($user, $request->request->get('password'));
                $user->setPassword($password);
            }
            // on met en place un message flash
            $this->addFlash('success', 'Votre profil a bien été ajouté');
            // on enregistre les modifications
            $em->persist($user);
            $em->flush();
            // on redirige vers la home page
            return $this->redirectToRoute('app_home');
        }
        //On rend la page en lui passant les tuto et les événements
        return $this->render('profil/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //Route pour modifier les informations du profil
    #[Route('/profil-edit', name: 'app_profil_edit')]

    public function editProfil(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        // On récupère l'utilisateur
        $user = $this->getUser();

        // On crée un formulaire avec les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données soumises dans le formulaire
            $formData = $form->getData();

            // Verifier si un nouveau mot de passe a été fourni
            $newPassword = $formData->getNewPassword();
            var_dump($newPassword);

            if (!empty($newPassword)) {
                // Encoder et définir le nouveau mot de passe 
                $hashedPassword = $encoder->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
            } else {
                $this->addFlash('success', 'Annulation des modifications');
            }

            /*  if (!is_null($request->get('password'))) {
                $password = $encoder->hashPassword($user, $request->request->get('password'));
                $user->setPassword($password);
            } */

            $this->addFlash('success', 'Votre profil a bien été modifié.');
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_profil');
        }
        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Ajouter un événement dans le profil (participation)
    #[Route('/add-event/{id}', name: 'add_event')]
    public function addEvent($id, EventRepository $eventRepository, EntityManagerInterface $em, Request $request): Response
    {
        // On récupère l'événement dans la base de données
        $event = $eventRepository->find($id);
        // On récupère l'utilisateur actuel
        $user = $this->getUser();
        //On ajoute l'événement à la liste de l'utilisateur
        $user->addEventsParticipation($event);
        //On met en place un message flash
        $this->addFlash('success', 'L\'événement a bien été ajouté dans votre profil : vous êtes considéré.e comme participant.e.');
        //On enregistre la modif
        $em->persist($user);
        $em->flush();
        // On redirige vers la page précédente
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/remove-event/{id}', name: 'remove_event')]
    public function removeEvent($id, EventRepository $eventRepository, EntityManagerInterface $em, Request $request): Response
    {
        // On récupère l'événement dans la base de données
        $event = $eventRepository->find($id);
        // On récupère l'utilisateur actuel
        $user = $this->getUser();
        //On enlève l'événement de l'utilisateur
        $user->removeEventsParticipation($event);
        //On met en place un message flash
        $this->addFlash('success', 'L\'événement a bien été supprimé de votre profil : vous n\'êtes plus considéré.e comme participant.e.');
        //On enregistre la modif
        $em->persist($user);
        $em->flush();
        //On reste sur la page où on est
        return $this->redirect($request->headers->get('referer'));
    }

    // Ajouter un tutoriel en favori
    #[Route('/add-favori/{id}', name: 'add_favori')]
    public function addFavori($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request): Response
    {
        // On récupère le tutoriel dans la base de données
        $tutorial = $tutorialRepository->find($id);
        // On récupère l'utilisateur actuel
        $user = $this->getUser();
        //On ajoute le tutoriel à la liste des favoris de l'utilisateur
        $user->addTutorial($tutorial);
        //On met en place un message flash
        $this->addFlash('success', 'Le favori a bien été ajouté dans votre profil.');
        //On enregistre la modif
        $em->persist($user);
        $em->flush();
        // On redirige vers la page précédente
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/remove-favori/{id}', name: 'remove_favori')]
    public function removeTutorial($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request): Response
    {
        // On récupère le tutoriel dans la base de données
        $tutorial = $tutorialRepository->find($id);
        // On récupère l'utilisateur actuel
        $user = $this->getUser();
        //On enlève le tutoriel de la liste des favoris de l'utilisateur
        $user->removeTutorial($tutorial);
        //On met en place un message flash
        $this->addFlash('success', 'Le favori a bien été supprimé de votre profil.');
        //On enregistre la modif
        $em->persist($user);
        $em->flush();
        //On reste sur la page où on est
        return $this->redirect($request->headers->get('referer'));
    }
}
