<?php

namespace App\Controller;

use App\Entity\MedicalFileIllness;
use App\Form\MedicalFileIllnessType;
use App\Repository\MedicalFileIllnessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/medical_file_illness')]
class AdminMedicalFileIllnessController extends AbstractController
{
    #[Route('/', name: 'app_admin_medical_file_illness_index', methods: ['GET'])]
    public function index(MedicalFileIllnessRepository $medicalFileIllnessRepository): Response
    {
        return $this->render('admin_medical_file_illness/index.html.twig', [
            'medical_file_illnesses' => $medicalFileIllnessRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_medical_file_illness_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedicalFileIllnessRepository $medicalFileIllnessRepository): Response
    {
        $medicalFileIllness = new MedicalFileIllness();
        $form = $this->createForm(MedicalFileIllnessType::class, $medicalFileIllness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalFileIllnessRepository->save($medicalFileIllness, true);

            return $this->redirectToRoute('app_admin_medical_file_illness_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medical_file_illness/new.html.twig', [
            'medical_file_illness' => $medicalFileIllness,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medical_file_illness_show', methods: ['GET'])]
    public function show(MedicalFileIllness $medicalFileIllness): Response
    {
        return $this->render('admin_medical_file_illness/show.html.twig', [
            'medical_file_illness' => $medicalFileIllness,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_medical_file_illness_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MedicalFileIllness $medicalFileIllness, MedicalFileIllnessRepository $medicalFileIllnessRepository): Response
    {
        $form = $this->createForm(MedicalFileIllnessType::class, $medicalFileIllness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalFileIllnessRepository->save($medicalFileIllness, true);

            return $this->redirectToRoute('app_admin_medical_file_illness_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medical_file_illness/edit.html.twig', [
            'medical_file_illness' => $medicalFileIllness,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medical_file_illness_delete', methods: ['POST'])]
    public function delete(Request $request, MedicalFileIllness $medicalFileIllness, MedicalFileIllnessRepository $medicalFileIllnessRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicalFileIllness->getId(), $request->request->get('_token'))) {
            $medicalFileIllnessRepository->remove($medicalFileIllness, true);
        }

        return $this->redirectToRoute('app_admin_medical_file_illness_index', [], Response::HTTP_SEE_OTHER);
    }
}
