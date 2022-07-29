<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    #[Route('/', name: 'foods')]
    public function index(FoodRepository $repository): Response
    {
        $foods = $repository->findAll();
        return $this->render('food/index.html.twig', [
            'controller_name' => 'FoodController',
            'foods' => $foods
        ]);
    }
}
