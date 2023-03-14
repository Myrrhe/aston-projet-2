<?php

namespace App\Entity;

use App\Repository\MedicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicationRepository::class)]
class Medication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'medicationId', targetEntity: PrescriptionMedication::class)]
    private Collection $prescriptionsMedications;

    public function __construct()
    {
        $this->prescriptionsMedications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PrescriptionMedication>
     */
    public function getPrescriptionsMedications(): Collection
    {
        return $this->prescriptionsMedications;
    }

    public function addPrescriptionsMedication(PrescriptionMedication $prescriptionsMedication): self
    {
        if (!$this->prescriptionsMedications->contains($prescriptionsMedication)) {
            $this->prescriptionsMedications->add($prescriptionsMedication);
            $prescriptionsMedication->setMedicationId($this);
        }

        return $this;
    }

    public function removePrescriptionsMedication(PrescriptionMedication $prescriptionsMedication): self
    {
        if ($this->prescriptionsMedications->removeElement($prescriptionsMedication)) {
            // set the owning side to null (unless already changed)
            if ($prescriptionsMedication->getMedicationId() === $this) {
                $prescriptionsMedication->setMedicationId(null);
            }
        }

        return $this;
    }
}
