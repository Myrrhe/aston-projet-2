<?php

namespace App\Controller;

use App\Entity\Nurse;
use App\Form\NurseType;
use App\Repository\NurseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/nurse')]
class AdminNurseController extends AbstractController
{
    #[Route('/', name: 'app_admin_nurse_index', methods: ['GET'])]
    public function index(NurseRepository $nurseRepository): Response
    {
        return $this->render('admin_nurse/index.html.twig', [
            'nurses' => $nurseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_nurse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NurseRepository $nurseRepository): Response
    {
        $nurse = new Nurse();
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nurseRepository->save($nurse, true);

            return $this->redirectToRoute('app_admin_nurse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_nurse/new.html.twig', [
            'nurse' => $nurse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_nurse_show', methods: ['GET'])]
    public function show(Nurse $nurse): Response
    {
        return $this->render('admin_nurse/show.html.twig', [
            'nurse' => $nurse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_nurse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nurse $nurse, NurseRepository $nurseRepository): Response
    {
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nurseRepository->save($nurse, true);

            return $this->redirectToRoute('app_admin_nurse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_nurse/edit.html.twig', [
            'nurse' => $nurse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_nurse_delete', methods: ['POST'])]
    public function delete(Request $request, Nurse $nurse, NurseRepository $nurseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nurse->getId(), $request->request->get('_token'))) {
            $nurseRepository->remove($nurse, true);
        }

        return $this->redirectToRoute('app_admin_nurse_index', [], Response::HTTP_SEE_OTHER);
    }
}
