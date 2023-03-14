<?php

namespace App\Controller;

use App\Entity\PrescriptionMedication;
use App\Form\PrescriptionMedicationType;
use App\Repository\PrescriptionMedicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/prescription_medication')]
class AdminPrescriptionMedicationController extends AbstractController
{
    #[Route('/', name: 'app_admin_prescription_medication_index', methods: ['GET'])]
    public function index(PrescriptionMedicationRepository $prescriptionMedicationRepository): Response
    {
        return $this->render('admin_prescription_medication/index.html.twig', [
            'prescription_medications' => $prescriptionMedicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_prescription_medication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrescriptionMedicationRepository $prescriptionMedicationRepository): Response
    {
        $prescriptionMedication = new PrescriptionMedication();
        $form = $this->createForm(PrescriptionMedicationType::class, $prescriptionMedication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prescriptionMedicationRepository->save($prescriptionMedication, true);

            return $this->redirectToRoute('app_admin_prescription_medication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prescription_medication/new.html.twig', [
            'prescription_medication' => $prescriptionMedication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_prescription_medication_show', methods: ['GET'])]
    public function show(PrescriptionMedication $prescriptionMedication): Response
    {
        return $this->render('admin_prescription_medication/show.html.twig', [
            'prescription_medication' => $prescriptionMedication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_prescription_medication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrescriptionMedication $prescriptionMedication, PrescriptionMedicationRepository $prescriptionMedicationRepository): Response
    {
        $form = $this->createForm(PrescriptionMedicationType::class, $prescriptionMedication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prescriptionMedicationRepository->save($prescriptionMedication, true);

            return $this->redirectToRoute('app_admin_prescription_medication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prescription_medication/edit.html.twig', [
            'prescription_medication' => $prescriptionMedication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_prescription_medication_delete', methods: ['POST'])]
    public function delete(Request $request, PrescriptionMedication $prescriptionMedication, PrescriptionMedicationRepository $prescriptionMedicationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prescriptionMedication->getId(), $request->request->get('_token'))) {
            $prescriptionMedicationRepository->remove($prescriptionMedication, true);
        }

        return $this->redirectToRoute('app_admin_prescription_medication_index', [], Response::HTTP_SEE_OTHER);
    }
}
