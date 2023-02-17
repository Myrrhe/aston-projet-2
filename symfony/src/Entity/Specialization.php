<?php

namespace App\Entity;

use App\Repository\SpecializationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecializationRepository::class)]
class Specialization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'specializationId', targetEntity: PhysicianSpecialization::class)]
    private Collection $physiciansSpecializations;

    public function __construct()
    {
        $this->physiciansSpecializations = new ArrayCollection();
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

    /**
     * @return Collection<int, PhysicianSpecialization>
     */
    public function getPhysiciansSpecializations(): Collection
    {
        return $this->physiciansSpecializations;
    }

    public function addPhysiciansSpecialization(PhysicianSpecialization $physiciansSpecialization): self
    {
        if (!$this->physiciansSpecializations->contains($physiciansSpecialization)) {
            $this->physiciansSpecializations->add($physiciansSpecialization);
            $physiciansSpecialization->setSpecializationId($this);
        }

        return $this;
    }

    public function removePhysiciansSpecialization(PhysicianSpecialization $physiciansSpecialization): self
    {
        if ($this->physiciansSpecializations->removeElement($physiciansSpecialization)) {
            // set the owning side to null (unless already changed)
            if ($physiciansSpecialization->getSpecializationId() === $this) {
                $physiciansSpecialization->setSpecializationId(null);
            }
        }

        return $this;
    }
}
