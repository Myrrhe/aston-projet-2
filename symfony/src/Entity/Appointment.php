<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\ManyToMany(targetEntity: Physician::class, inversedBy: 'appointments')]
    private Collection $physicians;

    #[ORM\ManyToMany(targetEntity: Nurse::class, inversedBy: 'appointments')]
    private Collection $nurses;

    #[ORM\ManyToMany(targetEntity: Patient::class, inversedBy: 'appointments')]
    private Collection $patients;

    #[ORM\OneToMany(mappedBy: 'appointmentId', targetEntity: Prescription::class)]
    private Collection $prescriptions;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $roomId = null;

    public function __construct()
    {
        $this->physicians = new ArrayCollection();
        $this->nurses = new ArrayCollection();
        $this->patients = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return Collection<int, Physician>
     */
    public function getPhysicians(): Collection
    {
        return $this->physicians;
    }

    public function addPhysician(Physician $physician): self
    {
        if (!$this->physicians->contains($physician)) {
            $this->physicians->add($physician);
        }

        return $this;
    }

    public function removePhysician(Physician $physician): self
    {
        $this->physicians->removeElement($physician);

        return $this;
    }

    /**
     * @return Collection<int, Nurse>
     */
    public function getNurses(): Collection
    {
        return $this->nurses;
    }

    public function addNurse(Nurse $nurse): self
    {
        if (!$this->nurses->contains($nurse)) {
            $this->nurses->add($nurse);
        }

        return $this;
    }

    public function removeNurse(Nurse $nurse): self
    {
        $this->nurses->removeElement($nurse);

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients->add($patient);
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        $this->patients->removeElement($patient);

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): self
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setAppointmentId($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getAppointmentId() === $this) {
                $prescription->setAppointmentId(null);
            }
        }

        return $this;
    }

    public function getRoomId(): ?Room
    {
        return $this->roomId;
    }

    public function setRoomId(?Room $roomId): self
    {
        $this->roomId = $roomId;

        return $this;
    }

    public function __toString()
    {
        return $this->description;
    }

    public function serialize(): array
    {
        return [
            'description' => $this->description,
            'starttime' => $this->startTime,
            'endtime' => $this->endTime,
            'room' => $this->roomId->serialize(),
        ];
    }
}
