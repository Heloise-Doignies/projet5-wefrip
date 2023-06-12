<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' =>$categories,
        ]);

    }
    #[Route('/category/{categorySlug}', name: 'app_category_show')]
    public function showCategory($categorySlug, CategoryRepository $categoryRepository): Response
    {
        //Jn récupère le video correspondant au slug
        $category = $categoryRepository->findOneBy(['categorySlug' => $categorySlug]);
        // On rend la page en lui passant le video
        return $this->render('category/show.html.twig', [
            'category' =>$category,
        ]);}
}
