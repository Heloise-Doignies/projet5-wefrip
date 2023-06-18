<?php

namespace App\Controller;

use App\Entity\Favori;
use App\Form\UserType;
use App\Entity\Tutorial;
use App\Entity\UserParticipant;
use App\Repository\EventRepository;
use App\Repository\FavoriRepository;
use App\Repository\TutorialRepository;
use App\Repository\UserParticipantRepository;
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
        // Récupérer les événements auxquels l'utilisateur participe
        $participantEvent = $user->getParticipantEvent();

       // on crée un formulaire avec les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
            // on vérifie si l'utilisateur a changé de mdp
                if(!is_null($request->request->get('plainPassword'))){
                    // on encode le nouveau mdp et on l'affecte au user
                    $password = $encoder->hashPassword($user, $request->request->get('plainPassword'));
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
        'participantEvent' => $participantEvent, // Pour les événements
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
        if ($form->isSubmitted() && $form->isValid()){
        if(!is_null($request->get('plainPassword'))){
        $password = $encoder->hashPassword($user,$request->request->get('plainPassword'));
        $user->setPassword($password);
        }
        $this->addFlash('success', 'Votre profil a bien été modifié.');
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('app_profil'); 
        }
        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    // #[Route('/add-favori/{id}', name:'add_favori' )]
    // public function addFavori($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request):Response
    // {
    //     // On récupère la video dans la BDD
    // $tutorial = $tutorialRepository->find($id);
    // // On récupère l'utilisateur
    // $user = $this ->getUser();
    // // On ajoute le tutoriel a la liste des favoris de l'utilisateur
    // $user->addTutorial($tutorial);
    // $this->addFlash('success',' Le tutoriel a bien été ajouté aux favoris.');
    // //On enregistre les modification 
    // $em->persist($user);
    // $em->flush();
    // //On redirige vers la page vidéo
    // return $this->redirect($request->headers->get('referer'));
    // }

    // #[Route('/remove-tutorial/{id}', name:'remove_tutorial' )]
    // public function removeTutorial($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request):Response
    // {
    //     // On récupère la video dans la BDD
    // $tutorial = $tutorialRepository->find($id);
    // // On récupère l'utilisateur
    // $user = $this ->getUser();
    // // On ajoute la video a la liste des favoris de l'utilisateur
    // $user->removeTutorial($tutorial);
    // $this->addFlash('success',' Le tutoriel a bien été supprimé des favoris.');
    // //On enregistre les modification 
    // $em->persist($user);
    // $em->flush();
    // //On redirige vers la page vidéo
    // return $this->redirect($request->headers->get('referer'));
    
    // }




    //Route pour ajouter les événements dans le profil (quand les personnes participent)
    #[Route('/add-event/{id}', name:'add_event' )]
    public function addEvent($id, EventRepository $eventRepository, EntityManagerInterface $em, Request $request):Response
    {
        // On récupère l'événement dans la BDD
    $event = $eventRepository->find($id);
    // On récupère l'utilisateur
    $user = $this ->getUser();

    //On crée un nouvel objet UserParticipant
    $participant = new UserParticipant();
    $participant -> addEvent($event);
    $participant -> addUsersId($user);
    
    $this->addFlash('success',' L\'événement a bien été ajouté dans votre profil.');
    //On enregistre les modifications
    $em->persist($participant);
    $em->flush();
    //On reste sur la page où on est
    return $this->redirect($request->headers->get('referer'));
    }

    //Route pour supprimer les événements dans le profil
    #[Route('/remove-event/{id}', name:'remove_event' )]
    public function removeEvent($id, UserParticipantRepository $userParticipantRepository, EntityManagerInterface $em, Request $request):Response
    {
    // On récupère l'utilisateur
    $user = $this->getUser();
    // On recherche le UserParticipant correspondant à l'ID
    $participant = $userParticipantRepository->findOneBy([
        'id' => $id,
        'usersId' => $user,
    ]);
    //On supprime le participant de l'événement
    $em->remove($participant);
    $em->flush();
    $this->addFlash('success',' L\'événement a bien été supprimé de votre profil : vous n\'êtes plus considéré.e comme participant.e.');
    //On reste sur la page où on est
    return $this->redirect($request->headers->get('referer'));
    }

   // Ajouter un favori
#[Route('/add-favori/{id}', name: 'add_favori')]
public function addFavori($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request): Response
{
    // On récupère le tutoriel dans la base de données
    $tutorial = $tutorialRepository->find($id);
    
    // On récupère l'utilisateur actuel
    $user = $this->getUser();

    // On vérifie si le favori n'existe pas déjà pour éviter les doublons
    $existingFavori = $user->getFavoris()->contains($tutorial);
    if (!$existingFavori) {
        // On crée un nouvel objet Favori
        $favori = new Favori();
        $favori->addTutorial($tutorial);
        $favori->addUser($user);

        // On enregistre le favori
        $em->persist($favori);
        $em->flush();

        $this->addFlash('success', 'Le favori a bien été ajouté dans votre profil.');
    } else {
        $this->addFlash('error', 'Ce favori existe déjà dans votre profil.');
    }

    // On redirige vers la page précédente
    return $this->redirect($request->headers->get('referer'));
}
// // Supprimer un favori
// #[Route('/remove-favori/{id}', name: 'remove_favori')]
// public function removeFavori($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request): Response
// {
//     // On récupère le favori dans la base de données
//     $favori = $tutorialRepository->find($id);
//     // On récupère l'utilisateur actuel
//     $user = $this->getUser();
//     // On vérifie si l'utilisateur a déjà ce favori
//     if ($favori && $favori->getUser() === $user) {
//         // On supprime le favori
//         $em->remove($favori);
//         $em->flush();
//         $this->addFlash('success', 'Le favori a bien été supprimé de votre profil.');
//     } else {
//         $this->addFlash('erreur', 'Ce favori n\'existe pas dans votre profil.');
//     }
//     // On redirige vers la page précédente
//     return $this->redirect($request->headers->get('referer'));
// 
#[Route('/remove-favori/{id}', name:'remove_favori' )]
public function removeFavori($id, FavoriRepository $favoriRepository, EntityManagerInterface $em, Request $request):Response
{
    // On récupère la video dans la BDD
$favori = $favoriRepository->find($id);
// On récupère l'utilisateur
$user = $this ->getUser();
// Rechercher la participation de l'utilisateur à cet événement
$tutorial = $favori->getTutorials($user);
if ($tutorial) {
    //Supprimer l'événement de la liste
    $tutorial->removeFavori($favori);
    //Supprimer l'utilisateur de la liste
    $favori->removeUsersId($user);
    //Enregistrer les modifications
    $this->addFlash('success',' favori a bien été supprimé de votre profil : vous n\'êtes plus considéré.e comme participant.e.');
    $em->persist($user);
    $em->flush();
}
//On reste sur la page où on est
return $this->redirect($request->headers->get('referer'));
}
}

