<?php

namespace App\Entity;

use App\Repository\PharmacyMedicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PharmacyMedicationRepository::class)]
class PharmacyMedication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $unitPrice = null;

    #[ORM\Column]
    private ?int $currentInventory = null;

    #[ORM\Column]
    private ?int $minimumInventory = null;

    #[ORM\ManyToOne(inversedBy: 'pharmaciesMedications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pharmacy $pharmacyId = null;

    #[ORM\ManyToOne(inversedBy: 'pharmaciesMedications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medication $medicationId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCurrentInventory(): ?int
    {
        return $this->currentInventory;
    }

    public function setCurrentInventory(int $currentInventory): self
    {
        $this->currentInventory = $currentInventory;

        return $this;
    }

    public function getMinimumInventory(): ?int
    {
        return $this->minimumInventory;
    }

    public function setMinimumInventory(int $minimumInventory): self
    {
        $this->minimumInventory = $minimumInventory;

        return $this;
    }

    public function getPharmacyId(): ?Pharmacy
    {
        return $this->pharmacyId;
    }

    public function setPharmacyId(?Pharmacy $pharmacyId): self
    {
        $this->pharmacyId = $pharmacyId;

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
}
