<?php

namespace App\Controller\admin;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/department')]
class AdminDepartmentController extends AbstractController
{
    #[Route('/', name: 'app_admin_department_index', methods: ['GET'])]
    public function index(DepartmentRepository $departmentRepository): Response
    {
        return $this->render('admin_department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_department_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepartmentRepository $departmentRepository): Response
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->save($department, true);

            return $this->redirectToRoute('app_admin_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_department/new.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_department_show', methods: ['GET'])]
    public function show(Department $department): Response
    {
        return $this->render('admin_department/show.html.twig', [
            'department' => $department,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_department_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->save($department, true);

            return $this->redirectToRoute('app_admin_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_department/edit.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_department_delete', methods: ['POST'])]
    public function delete(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getId(), $request->request->get('_token'))) {
            $departmentRepository->remove($department, true);
        }

        return $this->redirectToRoute('app_admin_department_index', [], Response::HTTP_SEE_OTHER);
    }
}
