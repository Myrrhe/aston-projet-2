<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $head = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $oathDate = null;

    #[ORM\OneToMany(mappedBy: 'departmentId', targetEntity: PhysicianDepartment::class)]
    private Collection $physiciansDepartments;

    public function __construct()
    {
        $this->physiciansDepartments = new ArrayCollection();
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

    public function getHead(): ?int
    {
        return $this->head;
    }

    public function setHead(?int $head): self
    {
        $this->head = $head;

        return $this;
    }

    public function getOathDate(): ?\DateTimeInterface
    {
        return $this->oathDate;
    }

    public function setOathDate(\DateTimeInterface $oathDate): self
    {
        $this->oathDate = $oathDate;

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
            $physiciansDepartment->setDepartmentId($this);
        }

        return $this;
    }

    public function removePhysiciansDepartment(PhysicianDepartment $physiciansDepartment): self
    {
        if ($this->physiciansDepartments->removeElement($physiciansDepartment)) {
            // set the owning side to null (unless already changed)
            if ($physiciansDepartment->getDepartmentId() === $this) {
                $physiciansDepartment->setDepartmentId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
