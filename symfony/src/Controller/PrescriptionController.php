<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Medication;
use App\Entity\Prescription;
use App\Entity\Physician;
use App\Entity\PrescriptionMedication;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PrescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrescriptionController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserService            $userService,
    ) {
    }

    #[Route('/write-prescription', name: 'write_prescription', methods: ['POST'])]
    public function writePrescription(
        Request $request,
        PrescriptionRepository $prescriptionRepository
    ): Response {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /** @var User */
            $user = $this->getUser();
            $role = $this->userService->whatAmI($user->getId());
            if ($role & 4) {
                $prescription = new Prescription();
                $parameters = $request->request->all();
                $physician = $this->entityManager->getRepository(Physician::class)->find($parameters['physician']);
                $prescription->setPhysicianId($physician);
                $appointment = $this->entityManager
                    ->getRepository(Appointment::class)
                    ->find($parameters['appointment']);
                $prescription->setAppointmentId($appointment);
                $prescription->setDate(new \DateTime($parameters['date']));
                $prescription->setDescription($parameters['description']);
                foreach ($parameters['medications'] as $medication) {
                    $arrayMedication = explode(';', $medication);
                    $prescriptionMedication = new PrescriptionMedication();
                    $medicationId = $this->entityManager->getRepository(Medication::class)->find($arrayMedication[0]);
                    $prescriptionMedication->setMedicationId($medicationId);
                    $prescriptionMedication->setQuantity($arrayMedication[1]);
                    $this->entityManager->persist($prescriptionMedication);
                    $prescription->addPrescriptionsMedication($prescriptionMedication);
                }
                $prescriptionRepository->save($prescription, true);
                return new Response("Prescription created successfully", Response::HTTP_OK);
            } else {
                return new Response(
                    "You must be a physician to write a prescription",
                    Response::HTTP_FORBIDDEN
                );
            }
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }
}
