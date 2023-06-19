<?php

namespace App\Controller;

use App\Repository\TutorialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeSupportController extends AbstractController
{
    #[Route('/type-support', name: 'app_type_support')]
    public function index(TutorialRepository $tutorialRepository): Response
    {
        $typesSupport = $tutorialRepository->findAll();
        return $this->render('type_support/index.html.twig', [
            'controller_name' => 'TypeSupportController',
            'typesSupport' =>$typesSupport,
        ]);
    }

    #[Route('/type-support/fiche', name: 'app_showFiche')]
    public function showFiche(TutorialRepository $tutorialRepository): Response
    {
        //Jn récupère le fiche correspondant au slug
        $typesSupport = $tutorialRepository->findBy(['tutoSupportType' => 'Fiche']);
        // On rend la page en lui passant le video
        return $this->render('type_support/show.html.twig', [
            'controller_name' => 'Les tutoriels fiches',
            'typesSupport' =>$typesSupport,

        ]);
    } 

    #[Route('/type-support/video', name: 'app_showVideo')]
    public function showVideo(TutorialRepository $tutorialRepository): Response
    {
        //Jn récupère le fiche correspondant au slug
        $typesSupport = $tutorialRepository->findBy(['tutoSupportType' => 'Vidéo']);
        // On rend la page en lui passant le video
        return $this->render('type_support/show.html.twig', [
            'controller_name' => 'Les tutoriels vidéos',
            'typesSupport' =>$typesSupport,
        ]);
    } 
    
}
