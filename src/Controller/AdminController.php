<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooklistType;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/addbook', name: 'addbook')]
    public function addbook(Request $request, ManagerRegistry $em): Response
    {
        $books = new Books();
        $form = $this->createForm(BooklistType::class, $books);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->getManager()->persist($books);
            $em->getManager()->flush();
            $this->addFlash('msg','Dodano książkę!');
        }

        return $this->render('admin/bookedit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/updatebook/{id}', name: 'updatebook')]
    public function updatebook(Request $request, ManagerRegistry $em, $id): Response
    {
        $books = $em->getRepository(Books::class)->find($id);
        $form = $this->createForm(BooklistType::class, $books);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->getManager()->persist($books);
            $em->getManager()->flush();
            $this->addFlash('msg','Edytowano książkę!');
        }

        return $this->render('admin/bookedit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/deletebook/{id}', name: 'deletebook')]
    public function deletebook(ManagerRegistry $em, $id): Response
    {
        $books = $em->getRepository(Books::class)->find($id);
        $em->getManager()->remove($books);
        $em->getManager()->flush();
        $this->addFlash('msg','Usunięto książkę!');
        return $this->redirectToRoute('booklist');
    }
    #[Route('/admin/booklist', name: 'booklist')]
    public function booklist(ManagerRegistry $em): Response
    {
        $data = $em->getRepository(Books::class)->findAll();
        return $this->render('admin/booklist.html.twig', [
            'list' => $data,
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
