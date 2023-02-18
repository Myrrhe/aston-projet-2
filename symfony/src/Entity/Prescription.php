<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Physician $physicianId = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appointment $appointmentId = null;

    #[ORM\OneToMany(mappedBy: 'prescriptionId', targetEntity: PrescriptionMedication::class)]
    private Collection $prescriptionsMedications;

    public function __construct()
    {
        $this->prescriptionsMedications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getPhysicianId(): ?Physician
    {
        return $this->physicianId;
    }

    public function setPhysicianId(?Physician $physicianId): self
    {
        $this->physicianId = $physicianId;

        return $this;
    }

    public function getAppointmentId(): ?Appointment
    {
        return $this->appointmentId;
    }

    public function setAppointmentId(?Appointment $appointmentId): self
    {
        $this->appointmentId = $appointmentId;

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
            $prescriptionsMedication->setPrescriptionId($this);
        }

        return $this;
    }

    public function removePrescriptionsMedication(PrescriptionMedication $prescriptionsMedication): self
    {
        if ($this->prescriptionsMedications->removeElement($prescriptionsMedication)) {
            // set the owning side to null (unless already changed)
            if ($prescriptionsMedication->getPrescriptionId() === $this) {
                $prescriptionsMedication->setPrescriptionId(null);
            }
        }

        return $this;
    }
}
