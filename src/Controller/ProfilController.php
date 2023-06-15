<?php

namespace App\Controller;

use App\Entity\UserParticipant;
use App\Form\UserType;
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
        // On récupère la video dans la BDD
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

    #[Route('/remove-event/{id}', name:'remove_event' )]
    public function removeEvent($id, EventRepository $eventRepository, EntityManagerInterface $em, Request $request):Response
    {
        // On récupère la video dans la BDD
    $event = $eventRepository->find($id);
    // On récupère l'utilisateur
    $user = $this ->getUser();
    // Rechercher la participation de l'utilisateur à cet événement
    $participant = $event->getParticipantByUser($user);
    if ($participant) {
        //Supprimer l'événement de la liste
        $participant->removeEvent($event);
        //Supprimer l'utilisateur de la liste
        $event->removeUsersId($user);
        //Enregistrer les modifications
        $this->addFlash('success',' L\'événement a bien été supprimé de votre profil : vous n\'êtes plus considéré.e comme participant.e.');
        $em->persist($user);
        $em->flush();
    }
    //On reste sur la page où on est
    return $this->redirect($request->headers->get('referer'));
    
    }
}
