<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Reservations;
use App\Form\BooklistType;
use App\Form\ReservationsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/books/', name: 'books')]
    public function books(ManagerRegistry $em, ?Request $request, ?string $name): Response
    {
        $data = $em->getRepository(Books::class)->findAll();
        $form = $this->createForm(BooklistType::class, $data, [
            'data_class' => null,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $em->getRepository(Books::class)->findBy(['name' => $name]);
            return $this->render('main/books.html.twig', [
                'list' => $data,
                'form' => $form->createView(),
            ]);
        }
        return $this->render('main/books.html.twig', [
            'list' => $data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile/resb', name: 'resb')]
    public function resb(Request $request, ManagerRegistry $em): Response
    {
        $res = new Reservations();
        $form = $this->createForm(ReservationsType::class, $res);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->getManager()->persist($res);
            $em->getManager()->flush();
            $this->addFlash('msg','Wypożyczono książkę!');
        }

        return $this->render('main/resb.html.twig', [
            'form' => $form->createView(),
            'user' => $user = $this->getUser(),
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
    #[Route('/profile/delr/{id}', name: 'delr')]
    public function delr(ManagerRegistry $em, $id): Response
    {
        $res = $em->getRepository(Reservations::class)->find($id);
        $em->getManager()->remove($res);
        $em->getManager()->flush();
        $this->addFlash('msg','Zwrócono książkę!');
        return $this->redirectToRoute('profile');
    }
}
