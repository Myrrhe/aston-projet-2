<?php

namespace App\Controller\admin;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/equipment')]
class AdminEquipmentController extends AbstractController
{
    #[Route('/', name: 'app_admin_equipment_index', methods: ['GET'])]
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('admin_equipment/index.html.twig', [
            'equipment' => $equipmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_equipment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipmentRepository $equipmentRepository): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentRepository->save($equipment, true);

            return $this->redirectToRoute('app_admin_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_equipment/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipment_show', methods: ['GET'])]
    public function show(Equipment $equipment): Response
    {
        return $this->render('admin_equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_equipment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipment $equipment, EquipmentRepository $equipmentRepository): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipmentRepository->save($equipment, true);

            return $this->redirectToRoute('app_admin_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipment_delete', methods: ['POST'])]
    public function delete(Request $request, Equipment $equipment, EquipmentRepository $equipmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipment->getId(), $request->request->get('_token'))) {
            $equipmentRepository->remove($equipment, true);
        }

        return $this->redirectToRoute('app_admin_equipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
