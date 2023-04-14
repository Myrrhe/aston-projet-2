<?php

namespace App\Entity;

use App\Repository\PhysicianDepartmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhysicianDepartmentRepository::class)]
class PhysicianDepartment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $primaryAffiliation = null;

    #[ORM\ManyToOne(inversedBy: 'physiciansDepartments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Physician $physicianId = null;

    #[ORM\ManyToOne(inversedBy: 'physiciansDepartments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Department $departmentId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPrimaryAffiliation(): ?bool
    {
        return $this->primaryAffiliation;
    }

    public function setPrimaryAffiliation(bool $primaryAffiliation): self
    {
        $this->primaryAffiliation = $primaryAffiliation;

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

    public function getDepartmentId(): ?Department
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?Department $departmentId): self
    {
        $this->departmentId = $departmentId;

        return $this;
    }

    public function __toString()
    {
        return $this->physicianId . ' - ' . $this->departmentId;
    }
}
