<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/admin/foods/new', name: 'app_admin_food_new')]
    #[Route('/admin/foods/{id}', name: 'app_admin_food_edit') ]
    public function new_and_edit(Food $food = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$food) {
          $food = new Food();
        }


        $form = $this->createForm(FoodType::class,$food);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $entityManager->persist($food);
          $entityManager->flush();
          return $this->redirectToRoute('app_admin_food');
        }


        return $this->render('admin_food/edit.html.twig', [
            'controller_name' => 'AdminFoodController',
            'food' => $food,
            'form' => $form->createView(),
            'new' => $food->getId() !== null
        ]);
    }

    #[Route('/admin/foods/delete/{id}', name: 'food_destroy')]
    public function destroy(Food $food, Request $request, EntityManagerInterface $entityManager): Response
    {
      if($this->isCsrfTokenValid("SUP". $food->getId(), $request->get('_token')))
      {
        $entityManager->remove($food);
        $entityManager->flush();
        return $this->redirectToRoute('app_admin_food');
      }
      return $this->redirectToRoute('foods');



    }
}
