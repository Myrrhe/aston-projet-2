<?php

namespace App\Controller\admin;

use App\Entity\PatientRoom;
use App\Form\PatientRoomType;
use App\Repository\PatientRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/patient_room')]
class AdminPatientRoomController extends AbstractController
{
    #[Route('/', name: 'app_admin_patient_room_index', methods: ['GET'])]
    public function index(PatientRoomRepository $patientRoomRepository): Response
    {
        return $this->render('admin_patient_room/index.html.twig', [
            'patient_rooms' => $patientRoomRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_patient_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRoomRepository $patientRoomRepository): Response
    {
        $patientRoom = new PatientRoom();
        $form = $this->createForm(PatientRoomType::class, $patientRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRoomRepository->save($patientRoom, true);

            return $this->redirectToRoute('app_admin_patient_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_patient_room/new.html.twig', [
            'patient_room' => $patientRoom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_patient_room_show', methods: ['GET'])]
    public function show(PatientRoom $patientRoom): Response
    {
        return $this->render('admin_patient_room/show.html.twig', [
            'patient_room' => $patientRoom,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_patient_room_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PatientRoom $patientRoom, PatientRoomRepository $patientRoomRepository): Response
    {
        $form = $this->createForm(PatientRoomType::class, $patientRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRoomRepository->save($patientRoom, true);

            return $this->redirectToRoute('app_admin_patient_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_patient_room/edit.html.twig', [
            'patient_room' => $patientRoom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_patient_room_delete', methods: ['POST'])]
    public function delete(Request $request, PatientRoom $patientRoom, PatientRoomRepository $patientRoomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patientRoom->getId(), $request->request->get('_token'))) {
            $patientRoomRepository->remove($patientRoom, true);
        }

        return $this->redirectToRoute('app_admin_patient_room_index', [], Response::HTTP_SEE_OTHER);
    }
}
