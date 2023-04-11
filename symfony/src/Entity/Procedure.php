<?php

namespace App\Entity;

use App\Repository\ProcedureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcedureRepository::class)]
#[ORM\Table(name: '`procedure`')]
class Procedure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $cost = null;

    #[ORM\ManyToMany(targetEntity: Physician::class, inversedBy: 'procedures')]
    private Collection $physicianId;

    #[ORM\ManyToMany(targetEntity: Specialization::class, inversedBy: 'procedures')]
    private Collection $specializations;

    public function __construct()
    {
        $this->physicianId = new ArrayCollection();
        $this->specializations = new ArrayCollection();
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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return Collection<int, Physician>
     */
    public function getPhysicianId(): Collection
    {
        return $this->physicianId;
    }

    public function addPhysicianId(Physician $physicianId): self
    {
        if (!$this->physicianId->contains($physicianId)) {
            $this->physicianId->add($physicianId);
        }

        return $this;
    }

    public function removePhysicianId(Physician $physicianId): self
    {
        $this->physicianId->removeElement($physicianId);

        return $this;
    }

    /**
     * @return Collection<int, Specialization>
     */
    public function getSpecializations(): Collection
    {
        return $this->specializations;
    }

    public function addSpecialization(Specialization $specialization): self
    {
        if (!$this->specializations->contains($specialization)) {
            $this->specializations->add($specialization);
        }

        return $this;
    }

    public function removeSpecialization(Specialization $specialization): self
    {
        $this->specializations->removeElement($specialization);

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
