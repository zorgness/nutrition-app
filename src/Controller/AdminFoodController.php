<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFoodController extends AbstractController
{
    #[Route('/admin/foods', name: 'app_admin_food')]
    public function index(FoodRepository $repository): Response
    {
        $foods = $repository->findAll();
        return $this->render('admin_food/index.html.twig', [
            'controller_name' => 'AdminFoodController',
            'foods' => $foods
        ]);
    }
}
