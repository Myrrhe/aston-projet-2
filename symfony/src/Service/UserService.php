<?php

namespace App\Service;

use App\Entity\Nurse;
use App\Entity\Patient;
use App\Entity\Physician;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function whatAmI(int $id): int
    {
        $nurse     = $this->entityManager->getRepository(Nurse::class)->findOneBy(['userId' => $id]);
        $patient   = $this->entityManager->getRepository(Patient::class)->findOneBy(['userId' => $id]);
        $physician = $this->entityManager->getRepository(Physician::class)->findOneBy(['userId' => $id]);
        return 1 * !empty($nurse) + 2 * !empty($patient) + 4 * !empty($physician);
    }
}
