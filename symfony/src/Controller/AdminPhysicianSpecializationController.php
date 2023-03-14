<?php

namespace App\Controller;

use App\Entity\PhysicianSpecialization;
use App\Form\PhysicianSpecializationType;
use App\Repository\PhysicianSpecializationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/physician_specialization')]
class AdminPhysicianSpecializationController extends AbstractController
{
    #[Route('/', name: 'app_admin_physician_specialization_index', methods: ['GET'])]
    public function index(PhysicianSpecializationRepository $physicianSpecializationRepository): Response
    {
        return $this->render('admin_physician_specialization/index.html.twig', [
            'physician_specializations' => $physicianSpecializationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_physician_specialization_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhysicianSpecializationRepository $physicianSpecializationRepository): Response
    {
        $physicianSpecialization = new PhysicianSpecialization();
        $form = $this->createForm(PhysicianSpecializationType::class, $physicianSpecialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianSpecializationRepository->save($physicianSpecialization, true);

            return $this->redirectToRoute('app_admin_physician_specialization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician_specialization/new.html.twig', [
            'physician_specialization' => $physicianSpecialization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_specialization_show', methods: ['GET'])]
    public function show(PhysicianSpecialization $physicianSpecialization): Response
    {
        return $this->render('admin_physician_specialization/show.html.twig', [
            'physician_specialization' => $physicianSpecialization,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_physician_specialization_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhysicianSpecialization $physicianSpecialization, PhysicianSpecializationRepository $physicianSpecializationRepository): Response
    {
        $form = $this->createForm(PhysicianSpecializationType::class, $physicianSpecialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianSpecializationRepository->save($physicianSpecialization, true);

            return $this->redirectToRoute('app_admin_physician_specialization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician_specialization/edit.html.twig', [
            'physician_specialization' => $physicianSpecialization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_specialization_delete', methods: ['POST'])]
    public function delete(Request $request, PhysicianSpecialization $physicianSpecialization, PhysicianSpecializationRepository $physicianSpecializationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$physicianSpecialization->getId(), $request->request->get('_token'))) {
            $physicianSpecializationRepository->remove($physicianSpecialization, true);
        }

        return $this->redirectToRoute('app_admin_physician_specialization_index', [], Response::HTTP_SEE_OTHER);
    }
}
