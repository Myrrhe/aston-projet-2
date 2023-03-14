<?php

namespace App\Controller;

use App\Entity\PhysicianDepartment;
use App\Form\PhysicianDepartmentType;
use App\Repository\PhysicianDepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/physician_department')]
class AdminPhysicianDepartmentController extends AbstractController
{
    #[Route('/', name: 'app_admin_physician_department_index', methods: ['GET'])]
    public function index(PhysicianDepartmentRepository $physicianDepartmentRepository): Response
    {
        return $this->render('admin_physician_department/index.html.twig', [
            'physician_departments' => $physicianDepartmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_physician_department_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhysicianDepartmentRepository $physicianDepartmentRepository): Response
    {
        $physicianDepartment = new PhysicianDepartment();
        $form = $this->createForm(PhysicianDepartmentType::class, $physicianDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianDepartmentRepository->save($physicianDepartment, true);

            return $this->redirectToRoute('app_admin_physician_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician_department/new.html.twig', [
            'physician_department' => $physicianDepartment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_department_show', methods: ['GET'])]
    public function show(PhysicianDepartment $physicianDepartment): Response
    {
        return $this->render('admin_physician_department/show.html.twig', [
            'physician_department' => $physicianDepartment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_physician_department_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhysicianDepartment $physicianDepartment, PhysicianDepartmentRepository $physicianDepartmentRepository): Response
    {
        $form = $this->createForm(PhysicianDepartmentType::class, $physicianDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $physicianDepartmentRepository->save($physicianDepartment, true);

            return $this->redirectToRoute('app_admin_physician_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_physician_department/edit.html.twig', [
            'physician_department' => $physicianDepartment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_physician_department_delete', methods: ['POST'])]
    public function delete(Request $request, PhysicianDepartment $physicianDepartment, PhysicianDepartmentRepository $physicianDepartmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$physicianDepartment->getId(), $request->request->get('_token'))) {
            $physicianDepartmentRepository->remove($physicianDepartment, true);
        }

        return $this->redirectToRoute('app_admin_physician_department_index', [], Response::HTTP_SEE_OTHER);
    }
}
