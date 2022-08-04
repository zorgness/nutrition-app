<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSecuController extends AbstractController
{
    #[Route('/admin/secu', name: 'app_admin_secu')]
    public function new( Request $request, EntityManagerInterface $entityManager): Response
    {

      $user = new User();
      $form = $this->createForm(RegistrationType::class,$user);

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash("success", 'user have been modified');
        return $this->redirectToRoute('foods');
      }
        return $this->render('admin_secu/new.html.twig', [
            'controller_name' => 'AdminSecuController',
            'form' => $form->createView()
        ]);
    }
}
