<?php

namespace App\Controller\admin;

use App\Entity\Prescription;
use App\Form\PrescriptionType;
use App\Repository\PrescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/prescription')]
class AdminPrescriptionController extends AbstractController
{
    #[Route('/', name: 'app_admin_prescription_index', methods: ['GET'])]
    public function index(PrescriptionRepository $prescriptionRepository): Response
    {
        return $this->render('admin_prescription/index.html.twig', [
            'prescriptions' => $prescriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_prescription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PrescriptionRepository $prescriptionRepository): Response
    {
        $prescription = new Prescription();
        $form = $this->createForm(PrescriptionType::class, $prescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prescriptionRepository->save($prescription, true);

            return $this->redirectToRoute('app_admin_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prescription/new.html.twig', [
            'prescription' => $prescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_prescription_show', methods: ['GET'])]
    public function show(Prescription $prescription): Response
    {
        return $this->render('admin_prescription/show.html.twig', [
            'prescription' => $prescription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_prescription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prescription $prescription, PrescriptionRepository $prescriptionRepository): Response
    {
        $form = $this->createForm(PrescriptionType::class, $prescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prescriptionRepository->save($prescription, true);

            return $this->redirectToRoute('app_admin_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prescription/edit.html.twig', [
            'prescription' => $prescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_prescription_delete', methods: ['POST'])]
    public function delete(Request $request, Prescription $prescription, PrescriptionRepository $prescriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prescription->getId(), $request->request->get('_token'))) {
            $prescriptionRepository->remove($prescription, true);
        }

        return $this->redirectToRoute('app_admin_prescription_index', [], Response::HTTP_SEE_OTHER);
    }
}
