<?php

namespace App\Controller\admin;

use App\Entity\Specialization;
use App\Form\SpecializationType;
use App\Repository\SpecializationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/specialization')]
class AdminSpecializationController extends AbstractController
{
    #[Route('/', name: 'app_admin_specialization_index', methods: ['GET'])]
    public function index(SpecializationRepository $specializationRepository): Response
    {
        return $this->render('admin_specialization/index.html.twig', [
            'specializations' => $specializationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_specialization_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SpecializationRepository $specializationRepository): Response
    {
        $specialization = new Specialization();
        $form = $this->createForm(SpecializationType::class, $specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specializationRepository->save($specialization, true);

            return $this->redirectToRoute('app_admin_specialization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_specialization/new.html.twig', [
            'specialization' => $specialization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_specialization_show', methods: ['GET'])]
    public function show(Specialization $specialization): Response
    {
        return $this->render('admin_specialization/show.html.twig', [
            'specialization' => $specialization,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_specialization_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Specialization $specialization, SpecializationRepository $specializationRepository): Response
    {
        $form = $this->createForm(SpecializationType::class, $specialization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specializationRepository->save($specialization, true);

            return $this->redirectToRoute('app_admin_specialization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_specialization/edit.html.twig', [
            'specialization' => $specialization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_specialization_delete', methods: ['POST'])]
    public function delete(Request $request, Specialization $specialization, SpecializationRepository $specializationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialization->getId(), $request->request->get('_token'))) {
            $specializationRepository->remove($specialization, true);
        }

        return $this->redirectToRoute('app_admin_specialization_index', [], Response::HTTP_SEE_OTHER);
    }
}
