<?php

namespace App\Entity;

use App\Repository\AllergyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergyRepository::class)]
class Allergy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: MedicalFile::class, mappedBy: 'allergies')]
    private Collection $medicalFiles;

    public function __construct()
    {
        $this->medicalFiles = new ArrayCollection();
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
     * @return Collection<int, MedicalFile>
     */
    public function getMedicalFiles(): Collection
    {
        return $this->medicalFiles;
    }

    public function addMedicalFile(MedicalFile $medicalFile): self
    {
        if (!$this->medicalFiles->contains($medicalFile)) {
            $this->medicalFiles->add($medicalFile);
            $medicalFile->addAllergy($this);
        }

        return $this;
    }

    public function removeMedicalFile(MedicalFile $medicalFile): self
    {
        if ($this->medicalFiles->removeElement($medicalFile)) {
            $medicalFile->removeAllergy($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
