<?php

namespace App\Entity;

use App\Repository\PhysicianSpecializationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhysicianSpecializationRepository::class)]
class PhysicianSpecialization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $primarySpecialization = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $certificationDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $certificationExpire = null;

    #[ORM\ManyToOne(inversedBy: 'physiciansSpecialization')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Physician $physicianId = null;

    #[ORM\ManyToOne(inversedBy: 'physiciansSpecializations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Specialization $specializationId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPrimarySpecialization(): ?bool
    {
        return $this->primarySpecialization;
    }

    public function setPrimarySpecialization(bool $primarySpecialization): self
    {
        $this->primarySpecialization = $primarySpecialization;

        return $this;
    }

    public function getCertificationDate(): ?\DateTimeInterface
    {
        return $this->certificationDate;
    }

    public function setCertificationDate(\DateTimeInterface $certificationDate): self
    {
        $this->certificationDate = $certificationDate;

        return $this;
    }

    public function getCertificationExpire(): ?\DateTimeInterface
    {
        return $this->certificationExpire;
    }

    public function setCertificationExpire(?\DateTimeInterface $certificationExpire): self
    {
        $this->certificationExpire = $certificationExpire;

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

    public function getSpecializationId(): ?Specialization
    {
        return $this->specializationId;
    }

    public function setSpecializationId(?Specialization $specializationId): self
    {
        $this->specializationId = $specializationId;

        return $this;
    }

    public function __toString()
    {
        return $this->physicianId . ' - ' . $this->specializationId;
    }
}
