<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTypeController extends AbstractController
{
    #[Route('/admin/type', name: 'app_admin_type')]
    public function index(TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();
        return $this->render('admin_type/index.html.twig', [
            'controller_name' => 'AdminTypeController',
            'types' => $types
        ]);
    }

    #[Route('/admin/types/new', name: 'app_admin_type_new')]
    #[Route('/admin/types/{id}', name: 'app_admin_type_edit') ]
    public function new_and_edit(Type $type = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$type) {
          $type = new Type();
        }


        $form = $this->createForm(FoodType::class,$type);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $entityManager->persist($type);
          $entityManager->flush();
          $this->addFlash("success", 'type have been modified');
          return $this->redirectToRoute('app_admin_type');
        }


        return $this->render('admin_type/edit.html.twig', [
            'controller_name' => 'AdmintypeController',
            'type' => $type,
            'form' => $form->createView(),
            'new' => $type->getId() !== null
        ]);
    }

}
