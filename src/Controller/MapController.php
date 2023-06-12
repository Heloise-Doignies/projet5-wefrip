<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route("/map", name: "app_map")]
    public function index(): Response
    {
        $latitude = 48.85;
        $longitude = 2.349903;
        $popupContent = "";
        $zoom = 19;
        $markers = [
            ["lat" => 48.85, "lng" => 2.349903, "ok" => "contenue"],
/*             ["lat" => 48.862395726039516, "lng" => 2.399574555185428, "popupContent" => 'cacacacaca'], */
        ];

        return $this->render("map/index.html.twig", [
            "controller_name" => "WeFrip'",
            "latitude" => $latitude,
            "longitude" => $longitude,
            "popupContent" => $popupContent,
            "zoom" => $zoom,
            "markers" => $markers,
        ]);
    }
}
