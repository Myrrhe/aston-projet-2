<?php

namespace App\Entity;

use App\Repository\PrescriptionMedicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionMedicationRepository::class)]
class PrescriptionMedication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptionsMedications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prescription $prescriptionId = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptionsMedications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medication $medicationId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrescriptionId(): ?Prescription
    {
        return $this->prescriptionId;
    }

    public function setPrescriptionId(?Prescription $prescriptionId): self
    {
        $this->prescriptionId = $prescriptionId;

        return $this;
    }

    public function getMedicationId(): ?Medication
    {
        return $this->medicationId;
    }

    public function setMedicationId(?Medication $medicationId): self
    {
        $this->medicationId = $medicationId;

        return $this;
    }

    public function __toString()
    {
        return $this->prescriptionId . ' ' . $this->medicationId;
    }
}
