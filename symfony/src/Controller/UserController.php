<?php

namespace App\Controller;

use App\Entity\Nurse;
use App\Entity\Patient;
use App\Entity\Physician;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserService            $userService,
    ) {
    }

    #[Route('/me', name: 'app_me')]
    public function me(): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /** @var User */
            $user = $this->getUser();
            return $this->json([
                'email'    => $user->getEmail(),
                'username' => $user->getUsername(),
            ]);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }

    #[Route('/my-addresses', name: 'my-addresses')]
    public function myAddresses(): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /** @var User */
            $user = $this->getUser();
            $addresses = $user->getAddresses();
            $res = [];
            foreach ($addresses as $address) {
                array_push($res, [
                    'street'  => $address->getStreet(),
                    'city'    => $address->getCity(),
                    'zipcode' => $address->getZipCode(),
                    'country' => $address->getCountry(),
                ]);
            }
            return $this->json($res);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }

    #[Route('/my-appointments', name: 'my-appointments')]
    public function myAppointments(): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /** @var User */
            $user = $this->getUser();
            $role = $this->userService->whatAmI($user->getId());
            if ($role === 0) {
                return $this->json([]);
            } else {
                $nurses     = $this->entityManager->getRepository(Nurse::class)
                    ->findBy(['userId' => $user->getId()]);
                $patients   = $this->entityManager->getRepository(Patient::class)
                    ->findBy(['userId' => $user->getId()]);
                $physicians = $this->entityManager->getRepository(Physician::class)
                    ->findBy(['userId' => $user->getId()]);
                $res = [
                    'nurse'     => [],
                    'patient'   => [],
                    'physician' => [],
                ];
                foreach ($nurses as $nurse) {
                    $appointements = $nurse->getAppointments();
                    foreach ($appointements as $appointement) {
                        array_push($res['nurse'], $appointement->serialize());
                    }
                }
                foreach ($patients as $patient) {
                    $appointements = $patient->getAppointments();
                    foreach ($appointements as $appointement) {
                        array_push($res['patient'], $appointement->serialize());
                    }
                }
                foreach ($physicians as $physician) {
                    $appointements = $physician->getAppointments();
                    foreach ($appointements as $appointement) {
                        array_push($res['physician'], $appointement->serialize());
                    }
                }
            }
            return $this->json($res);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }

    #[Route('/my-prescriptions', name: 'my-prescriptions')]
    public function myPrescriptions(): Response
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            /** @var User */
            $user = $this->getUser();
            $role = $this->userService->whatAmI($user->getId());
            if ($role === 0) {
                return $this->json([]);
            } else {
                $patients   = $this->entityManager->getRepository(Patient::class)
                    ->findBy(['userId' => $user->getId()]);
                $physicians = $this->entityManager->getRepository(Physician::class)
                    ->findBy(['userId' => $user->getId()]);
                $res = [
                    'patient'   => [],
                    'physician' => [],
                ];
                foreach ($patients as $patient) {
                    $appointements = $patient->getAppointments();
                    foreach ($appointements as $appointement) {
                        $prescriptions = $appointement->getPrescriptions();
                        foreach ($prescriptions as $prescription) {
                            array_push($res['patient'], $prescription->serialize());
                        }
                    }
                }
                foreach ($physicians as $physician) {
                    $prescriptions = $physician->getPrescriptions();
                    foreach ($prescriptions as $prescription) {
                        array_push($res['physician'], $prescription->serialize());
                    }
                }
            }
            return $this->json($res);
        } else {
            return new Response("You need to be logged", Response::HTTP_FORBIDDEN);
        }
    }
}
