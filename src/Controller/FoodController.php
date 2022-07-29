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
            'foods' => $foods,
            'isAll' => true,
            "isCalorie" => false,
            "isCarbohydrate" => false,
        ]);
    }

    #[Route('foods/calories/{calorie}', name: 'food_by_calorie')]
    public function foodByCalories(FoodRepository $repository, $calorie): Response
    {
        $foods = $repository->getFoodsByProperties('calorie', '<' ,$calorie);
        return $this->render('food/index.html.twig', [
            'controller_name' => 'FoodController',
            'foods' => $foods,
            'isAll' => false,
            "isCalorie" => true,
            "isCarbohydrate" => false
        ]);
    }

    #[Route('foods/carbohydrates/{carbohydrates}', name: 'food_by_carbohydrates')]
    public function foodByCarbohydrates(FoodRepository $repository, $carbohydrates): Response
    {
        $foods = $repository->getFoodsByProperties('carbohydrates', '<' ,$carbohydrates);
        return $this->render('food/index.html.twig', [
            'controller_name' => 'FoodController',
            'foods' => $foods,
            'isAll' => false,
            "isCalorie" => false,
            "isCarbohydrate" => true
        ]);
    }


}
