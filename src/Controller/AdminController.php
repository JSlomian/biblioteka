<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooklistType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/addbook', name: 'addbook')]
    public function addbook(Request $request): Response
    {
        $books = new Books();
        $form = $this->createForm(BooklistType::class, $books);
        $form->handleRequest($request);

        return $this->render('admin/addbook.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/updatebook', name: 'updatebook')]
    public function updatebook(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/deletebook', name: 'deletebook')]
    public function deletebook(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/reservations', name: 'reservations')]
    public function reservations(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
