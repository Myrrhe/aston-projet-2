<?php

namespace App\Entity;

use App\Repository\PhysicianRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhysicianRepository::class)]
class Physician
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ssn = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $licenseNumber = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\OneToMany(mappedBy: 'physicianId', targetEntity: PhysicianDepartment::class)]
    private Collection $physiciansDepartments;

    #[ORM\OneToMany(mappedBy: 'physicianId', targetEntity: PhysicianSpecialization::class)]
    private Collection $physiciansSpecializations;

    #[ORM\ManyToMany(targetEntity: Appointment::class, mappedBy: 'physicians')]
    private Collection $appointments;

    #[ORM\OneToMany(mappedBy: 'physicianId', targetEntity: Prescription::class)]
    private Collection $prescriptions;

    public function __construct()
    {
        $this->physiciansDepartments = new ArrayCollection();
        $this->physiciansSpecializations = new ArrayCollection();
        $this->appointments = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSsn(): ?int
    {
        return $this->ssn;
    }

    public function setSsn(int $ssn): self
    {
        $this->ssn = $ssn;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getLicenseNumber(): ?string
    {
        return $this->licenseNumber;
    }

    public function setLicenseNumber(string $licenseNumber): self
    {
        $this->licenseNumber = $licenseNumber;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection<int, PhysicianDepartment>
     */
    public function getPhysiciansDepartments(): Collection
    {
        return $this->physiciansDepartments;
    }

    public function addPhysiciansDepartment(PhysicianDepartment $physiciansDepartment): self
    {
        if (!$this->physiciansDepartments->contains($physiciansDepartment)) {
            $this->physiciansDepartments->add($physiciansDepartment);
            $physiciansDepartment->setPhysicianId($this);
        }

        return $this;
    }

    public function removePhysiciansDepartment(PhysicianDepartment $physiciansDepartment): self
    {
        if ($this->physiciansDepartments->removeElement($physiciansDepartment)) {
            // set the owning side to null (unless already changed)
            if ($physiciansDepartment->getPhysicianId() === $this) {
                $physiciansDepartment->setPhysicianId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PhysicianSpecialization>
     */
    public function getPhysiciansSpecializations(): Collection
    {
        return $this->physiciansSpecializations;
    }

    public function addPhysiciansSpecializations(PhysicianSpecialization $physiciansSpecializations): self
    {
        if (!$this->physiciansSpecializations->contains($physiciansSpecializations)) {
            $this->physiciansSpecializations->add($physiciansSpecializations);
            $physiciansSpecializations->setPhysicianId($this);
        }

        return $this;
    }

    public function removePhysiciansSpecializations(PhysicianSpecialization $physiciansSpecializations): self
    {
        if ($this->physiciansSpecializations->removeElement($physiciansSpecializations)) {
            // set the owning side to null (unless already changed)
            if ($physiciansSpecializations->getPhysicianId() === $this) {
                $physiciansSpecializations->setPhysicianId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->addPhysician($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            $appointment->removePhysician($this);
        }

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
            $prescription->setPhysicianId($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getPhysicianId() === $this) {
                $prescription->setPhysicianId(null);
            }
        }

        return $this;
    }
}
