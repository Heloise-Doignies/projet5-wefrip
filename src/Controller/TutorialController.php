<?php

namespace App\Controller;

use App\Repository\TutorialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TutorialController extends AbstractController
{
    #[Route('/tutorial', name: 'app_tutorial')]
    public function index(TutorialRepository $tutorialRepository): Response
    {

         //Ajout d'un message flash pour les user qui n'ont pas confirmé leur mail
        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && !$this->getUser()->isVerified()) {
            $this->addFlash('warning', 'Pour rappel, veuillez confirmer votre profil avec le lien reçu par mail pour profiter de toutes les fonctionnalités.');
        }

        $tutorials = $tutorialRepository->findAll();
        return $this->render('tutorial/index.html.twig', [
            'tutorials' =>$tutorials,
        ]);
    }

    #[Route('/tutorial/{tutoSlug}', name: 'app_tutorial_show')]
    public function showTutorial($tutoSlug, TutorialRepository $tutorialRepository): Response
    {
        //Jn récupère le video correspondant au slug
        $tutorial = $tutorialRepository->findOneBy(['tutoSlug' => $tutoSlug]);
        // On rend la page en lui passant le video
        return $this->render('tutorial/show.html.twig', [
            'tutorial' =>$tutorial,
        ]);}

}
