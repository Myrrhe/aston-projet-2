<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Nurse;
use App\Entity\Patient;
use App\Entity\Physician;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/book-appointment', name: 'book_appointment', methods: ['POST'])]
    public function bookAppointment(
        Request $request,
        AppointmentRepository $appointmentRepository
    ): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $appointment = new Appointment();
            $parameters = $request->request->all();
            $room = $this->entityManager->getRepository(Room::class)->find($parameters['room']);
            $appointment->setRoomId($room);
            $appointment->setDescription($parameters['description']);
            $appointment->setStartTime(new \DateTime($parameters['start']));
            $appointment->setEndTime(new \DateTime($parameters['end']));
            foreach ($parameters['nurses'] as $nurseId) {
                $nurse = $this->entityManager->getRepository(Nurse::class)->find($nurseId);
                $appointment->addNurse($nurse);
            }
            foreach ($parameters['patients'] as $patientId) {
                $patient = $this->entityManager->getRepository(Patient::class)->find($patientId);
                $appointment->addPatient($patient);
            }
            foreach ($parameters['physicians'] as $physicianId) {
                $physician = $this->entityManager->getRepository(Physician::class)->find($physicianId);
                $appointment->addPhysician($physician);
            }
            $appointmentRepository->save($appointment, true);
            return new Response("Appointment created successfully", Response::HTTP_OK);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }
}
