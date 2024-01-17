<?php

namespace App\Controller;

use App\Entity\NumeroLoteria;
use App\Form\NumeroLoteriaType;
use App\Repository\NumeroLoteriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/numero/loteria')]
class NumeroLoteriaController extends AbstractController
{
    #[Route('/', name: 'app_numero_loteria_index', methods: ['GET'])]
    public function index(NumeroLoteriaRepository $numeroLoteriaRepository): Response
    {
        return $this->render('numero_loteria/index.html.twig', [
            'numero_loterias' => $numeroLoteriaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_numero_loteria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $numeroLoterium = new NumeroLoteria();
        $form = $this->createForm(NumeroLoteriaType::class, $numeroLoterium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($numeroLoterium);
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_loteria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('numero_loteria/new.html.twig', [
            'numero_loterium' => $numeroLoterium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_loteria_show', methods: ['GET'])]
    public function show(NumeroLoteria $numeroLoterium): Response
    {
        return $this->render('numero_loteria/show.html.twig', [
            'numero_loterium' => $numeroLoterium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_numero_loteria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NumeroLoteria $numeroLoterium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NumeroLoteriaType::class, $numeroLoterium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_numero_loteria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('numero_loteria/edit.html.twig', [
            'numero_loterium' => $numeroLoterium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_numero_loteria_delete', methods: ['POST'])]
    public function delete(Request $request, NumeroLoteria $numeroLoterium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numeroLoterium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($numeroLoterium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_numero_loteria_index', [], Response::HTTP_SEE_OTHER);
    }
}
