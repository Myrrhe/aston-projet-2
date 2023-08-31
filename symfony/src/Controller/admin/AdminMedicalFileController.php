<?php

namespace App\Controller\admin;

use App\Entity\MedicalFile;
use App\Form\MedicalFileType;
use App\Repository\MedicalFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/medical_file')]
class AdminMedicalFileController extends AbstractController
{
    #[Route('/', name: 'app_admin_medical_file_index', methods: ['GET'])]
    public function index(MedicalFileRepository $medicalFileRepository): Response
    {
        return $this->render('admin_medical_file/index.html.twig', [
            'medical_files' => $medicalFileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_medical_file_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedicalFileRepository $medicalFileRepository): Response
    {
        $medicalFile = new MedicalFile();
        $form = $this->createForm(MedicalFileType::class, $medicalFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalFileRepository->save($medicalFile, true);

            return $this->redirectToRoute('app_admin_medical_file_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medical_file/new.html.twig', [
            'medical_file' => $medicalFile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medical_file_show', methods: ['GET'])]
    public function show(MedicalFile $medicalFile): Response
    {
        return $this->render('admin_medical_file/show.html.twig', [
            'medical_file' => $medicalFile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_medical_file_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MedicalFile $medicalFile, MedicalFileRepository $medicalFileRepository): Response
    {
        $form = $this->createForm(MedicalFileType::class, $medicalFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicalFileRepository->save($medicalFile, true);

            return $this->redirectToRoute('app_admin_medical_file_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_medical_file/edit.html.twig', [
            'medical_file' => $medicalFile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_medical_file_delete', methods: ['POST'])]
    public function delete(Request $request, MedicalFile $medicalFile, MedicalFileRepository $medicalFileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicalFile->getId(), $request->request->get('_token'))) {
            $medicalFileRepository->remove($medicalFile, true);
        }

        return $this->redirectToRoute('app_admin_medical_file_index', [], Response::HTTP_SEE_OTHER);
    }
}
