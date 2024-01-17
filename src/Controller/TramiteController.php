<?php

namespace App\Controller;

use App\Entity\Tramite;
use App\Form\TramiteType;
use App\Repository\TramiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tramite')]
class TramiteController extends AbstractController
{
    #[Route('/', name: 'app_tramite_index', methods: ['GET'])]
    public function index(TramiteRepository $tramiteRepository): Response
    {
        return $this->render('tramite/index.html.twig', [
            'tramites' => $tramiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tramite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tramite = new Tramite();
        $form = $this->createForm(TramiteType::class, $tramite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tramite);
            $entityManager->flush();

            return $this->redirectToRoute('app_tramite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tramite/new.html.twig', [
            'tramite' => $tramite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tramite_show', methods: ['GET'])]
    public function show(Tramite $tramite): Response
    {
        return $this->render('tramite/show.html.twig', [
            'tramite' => $tramite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tramite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tramite $tramite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TramiteType::class, $tramite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tramite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tramite/edit.html.twig', [
            'tramite' => $tramite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tramite_delete', methods: ['POST'])]
    public function delete(Request $request, Tramite $tramite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tramite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tramite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tramite_index', [], Response::HTTP_SEE_OTHER);
    }
}
