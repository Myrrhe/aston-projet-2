<?php

namespace App\Controller\admin;

use App\Entity\Physician;
use App\Form\PhysicianType;
use App\Repository\PhysicianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/physician')]
class AdminPhysicianController extends AbstractController
{
    #[Route('/', name: 'app_admin_physician_index', methods: ['GET'])]
    public function index(PhysicianRepository $physicianRepository): Response
    {
        return $this->render('admin_physician/index.html.twig', [
            'physicians' => $physicianRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_physician_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhysicianRepository $physicianRepository): Response
    {
        $physician = new Physician();
        $form = $this->createForm(PhysicianType::class, $physician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianRepository->save($physician, true);

            return $this->redirectToRoute('app_admin_physician_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician/new.html.twig', [
            'physician' => $physician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_show', methods: ['GET'])]
    public function show(Physician $physician): Response
    {
        return $this->render('admin_physician/show.html.twig', [
            'physician' => $physician,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_physician_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Physician $physician, PhysicianRepository $physicianRepository): Response
    {
        $form = $this->createForm(PhysicianType::class, $physician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianRepository->save($physician, true);

            return $this->redirectToRoute('app_admin_physician_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician/edit.html.twig', [
            'physician' => $physician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_delete', methods: ['POST'])]
    public function delete(Request $request, Physician $physician, PhysicianRepository $physicianRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$physician->getId(), $request->request->get('_token'))) {
            $physicianRepository->remove($physician, true);
        }

        return $this->redirectToRoute('app_admin_physician_index', [], Response::HTTP_SEE_OTHER);
    }
}
