<?php

namespace App\Controller;

use App\Entity\Medication;
use App\Form\MedicationType;
use App\Repository\MedicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/medication')]
class AdminMedicationController extends AbstractController
{
    #[Route('/', name: 'app_admin_medication_index', methods: ['GET'])]
    public function index(MedicationRepository $medicationRepository): Response
    {
        return $this->render('admin_medication/index.html.twig', [
            'medications' => $medicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_medication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedicationRepository $medicationRepository): Response
    {
        $medication = new Medication();
        $form = $this->createForm(MedicationType::class, $medication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicationRepository->save($medication, true);

            return $this->redirectToRoute('app_admin_medication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medication/new.html.twig', [
            'medication' => $medication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medication_show', methods: ['GET'])]
    public function show(Medication $medication): Response
    {
        return $this->render('admin_medication/show.html.twig', [
            'medication' => $medication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_medication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medication $medication, MedicationRepository $medicationRepository): Response
    {
        $form = $this->createForm(MedicationType::class, $medication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicationRepository->save($medication, true);

            return $this->redirectToRoute('app_admin_medication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medication/edit.html.twig', [
            'medication' => $medication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medication_delete', methods: ['POST'])]
    public function delete(Request $request, Medication $medication, MedicationRepository $medicationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medication->getId(), $request->request->get('_token'))) {
            $medicationRepository->remove($medication, true);
        }

        return $this->redirectToRoute('app_admin_medication_index', [], Response::HTTP_SEE_OTHER);
    }
}
