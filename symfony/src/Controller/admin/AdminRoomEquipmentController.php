<?php

namespace App\Controller\admin;

use App\Entity\RoomEquipment;
use App\Form\RoomEquipmentType;
use App\Repository\RoomEquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/room_equipment')]
class AdminRoomEquipmentController extends AbstractController
{
    #[Route('/', name: 'app_admin_room_equipment_index', methods: ['GET'])]
    public function index(RoomEquipmentRepository $roomEquipmentRepository): Response
    {
        return $this->render('admin_room_equipment/index.html.twig', [
            'room_equipments' => $roomEquipmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_room_equipment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RoomEquipmentRepository $roomEquipmentRepository): Response
    {
        $roomEquipment = new RoomEquipment();
        $form = $this->createForm(RoomEquipmentType::class, $roomEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomEquipmentRepository->save($roomEquipment, true);

            return $this->redirectToRoute('app_admin_room_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_room_equipment/new.html.twig', [
            'room_equipment' => $roomEquipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_room_equipment_show', methods: ['GET'])]
    public function show(RoomEquipment $roomEquipment): Response
    {
        return $this->render('admin_room_equipment/show.html.twig', [
            'room_equipment' => $roomEquipment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_room_equipment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RoomEquipment $roomEquipment, RoomEquipmentRepository $roomEquipmentRepository): Response
    {
        $form = $this->createForm(RoomEquipmentType::class, $roomEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomEquipmentRepository->save($roomEquipment, true);

            return $this->redirectToRoute('app_admin_room_equipment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_room_equipment/edit.html.twig', [
            'room_equipment' => $roomEquipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_room_equipment_delete', methods: ['POST'])]
    public function delete(Request $request, RoomEquipment $roomEquipment, RoomEquipmentRepository $roomEquipmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomEquipment->getId(), $request->request->get('_token'))) {
            $roomEquipmentRepository->remove($roomEquipment, true);
        }

        return $this->redirectToRoute('app_admin_room_equipment_index', [], Response::HTTP_SEE_OTHER);
    }
}
