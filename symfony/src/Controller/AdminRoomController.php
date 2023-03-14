<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/room')]
class AdminRoomController extends AbstractController
{
    #[Route('/', name: 'app_admin_room_index', methods: ['GET'])]
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('admin_room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RoomRepository $roomRepository): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomRepository->save($room, true);

            return $this->redirectToRoute('app_admin_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_room/new.html.twig', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_room_show', methods: ['GET'])]
    public function show(Room $room): Response
    {
        return $this->render('admin_room/show.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_room_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Room $room, RoomRepository $roomRepository): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomRepository->save($room, true);

            return $this->redirectToRoute('app_admin_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_room/edit.html.twig', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_room_delete', methods: ['POST'])]
    public function delete(Request $request, Room $room, RoomRepository $roomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $roomRepository->remove($room, true);
        }

        return $this->redirectToRoute('app_admin_room_index', [], Response::HTTP_SEE_OTHER);
    }
}
