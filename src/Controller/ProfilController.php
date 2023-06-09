<?php

namespace App\Controller;

use App\Form\UserType;
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
       //On rend la page en lui passant les vidéos correspondantes
        return $this->render('profil/index.html.twig', [
        'user' => $user,
        ]);  
    }

    #[Route('/profil-edit', name: 'app_profil_edit')]
    public function editProfil(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
         // On recupere l'utilisateur
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
        return $this->render('profil/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/add-favori/{id}', name:'add_favori' )]
    public function addFavori($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request):Response
    {
        // On récupère la video dans la BDD
    $tutorial = $tutorialRepository->find($id);
    // On récupère l'utilisateur
    $user = $this ->getUser();
    // On ajoute la video a la liste des favoris de l'utilisateur
    $user->addTutorial($tutorial);
    $this->addFlash('success',' Le tutoriel a bien été ajouté aux favoris.');
    //On enregistre les modification 
    $em->persist($user);
    $em->flush();
    //On redirige vers la page vidéo
    return $this->redirect($request->headers->get('referer'));


    }

    #[Route('/remove-tutorial/{id}', name:'remove_tutorial' )]
    public function removeTutorial($id, TutorialRepository $tutorialRepository, EntityManagerInterface $em, Request $request):Response
    {
        // On récupère la video dans la BDD
    $tutorial = $tutorialRepository->find($id);
    // On récupère l'utilisateur
    $user = $this ->getUser();
    // On ajoute la video a la liste des favoris de l'utilisateur
    $user->removeTutorial($tutorial);
    $this->addFlash('success',' Le tutoriel a bien été supprimé des favoris.');
    //On enregistre les modification 
    $em->persist($user);
    $em->flush();
    //On redirige vers la page vidéo
    return $this->redirect($request->headers->get('referer'));
    
    }
}
