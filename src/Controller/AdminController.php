<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Reservations;
use App\Form\BooklistType;
use App\Form\ReservationsType;
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
    #[Route('/admin/addres', name: 'addres')]
    public function addres(Request $request, ManagerRegistry $em): Response
    {
        $res = new Reservations();
        $form = $this->createForm(ReservationsType::class, $res);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->getManager()->persist($res);
            $em->getManager()->flush();
            $this->addFlash('msg','Wypożyczono książkę!');
        }

        return $this->render('admin/resedit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservations', name: 'reservations')]
    public function reservations(ManagerRegistry $em): Response
    {
        $data = $em->getRepository(Reservations::class)->findAll();
        return $this->render('admin/reservations.html.twig', [
            'list' => $data,
        ]);
    }

    #[Route('/admin/deleteres/{id}', name: 'deleteres')]
    public function deleteres(ManagerRegistry $em, $id): Response
    {
        $res = $em->getRepository(Reservations::class)->find($id);
        $em->getManager()->remove($res);
        $em->getManager()->flush();
        $this->addFlash('msg','Zwrócono książkę!');
        return $this->redirectToRoute('reservations');
    }
}
