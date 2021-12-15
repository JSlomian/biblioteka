<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Reservations;
use App\Form\BooklistType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    #[Route('/{name?}', name: 'main')]
    public function index(ManagerRegistry $em, ?Request $request, ?string $name): Response
    {
        $data = $em->getRepository(Books::class)->findAll();
        $form = $this->createForm(TextType::class, $data);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $em->getRepository(Books::class)->findBy(['name' => $name]);
            return $this->render('main/index.html.twig', [
            'list' => $data,
            'form' => $form->createView(),
        ]);
        }
        return $this->render('main/index.html.twig', [
            'list' => $data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile', name: 'profile')]
    public function profile(ManagerRegistry $em): Response
    {
        $user = $this->getUser();
        $data = $em->getRepository(Reservations::class)->findBy(['uemail' => $user]);
        return $this->render('main/profile.html.twig', [
            'list' => $data,
            'asd' => $user,
        ]);
    }
}
