<?php

namespace App\Entity;

use App\Repository\NurseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NurseRepository::class)]
class Nurse
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

    #[ORM\ManyToMany(targetEntity: Appointment::class, mappedBy: 'nurses')]
    private Collection $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
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
            $appointment->addNurse($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            $appointment->removeNurse($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
