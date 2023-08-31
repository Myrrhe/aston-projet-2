<?php

namespace App\Controller\admin;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/patient')]
class AdminPatientController extends AbstractController
{
    #[Route('/', name: 'app_admin_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('admin_patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRepository $patientRepository): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->save($patient, true);

            return $this->redirectToRoute('app_admin_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        return $this->render('admin_patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->save($patient, true);

            return $this->redirectToRoute('app_admin_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_patient_delete', methods: ['POST'])]
    public function delete(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $patientRepository->remove($patient, true);
        }

        return $this->redirectToRoute('app_admin_patient_index', [], Response::HTTP_SEE_OTHER);
    }
}
