<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]
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


        $form = $this->createForm(TypeType::class,$type);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $entityManager->persist($type);
          $entityManager->flush();
          $this->addFlash("success", 'type have been modified');
          return $this->redirectToRoute('app_admin_type');
        }


        return $this->render('admin_type/edit.html.twig', [
            'controller_name' => 'AdminTypeController',
            'type' => $type,
            'form' => $form->createView(),
            'new' => $type->getId() !== null
        ]);
    }
    #[Route('/admin/types/delete/{id}', name: 'type_destroy')]
    public function destroy(Type $type, Request $request, EntityManagerInterface $entityManager): Response
    {
      if($this->isCsrfTokenValid("SUP". $type->getId(), $request->get('_token')))
      {
        $entityManager->remove($type);
        $entityManager->flush();
        $this->addFlash("success", 'Type have been deleted');
        return $this->redirectToRoute('app_admin_type');
      }
    }

}
