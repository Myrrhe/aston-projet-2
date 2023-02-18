<?php

namespace App\Entity;

use App\Repository\IllnessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IllnessRepository::class)]
class Illness
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'illnessId', targetEntity: MedicalFileIllness::class)]
    private Collection $medicalFilesIllnesses;

    public function __construct()
    {
        $this->medicalFilesIllnesses = new ArrayCollection();
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
     * @return Collection<int, MedicalFileIllness>
     */
    public function getMedicalFilesIllnesses(): Collection
    {
        return $this->medicalFilesIllnesses;
    }

    public function addMedicalFilesIllness(MedicalFileIllness $medicalFilesIllness): self
    {
        if (!$this->medicalFilesIllnesses->contains($medicalFilesIllness)) {
            $this->medicalFilesIllnesses->add($medicalFilesIllness);
            $medicalFilesIllness->setIllnessId($this);
        }

        return $this;
    }

    public function removeMedicalFilesIllness(MedicalFileIllness $medicalFilesIllness): self
    {
        if ($this->medicalFilesIllnesses->removeElement($medicalFilesIllness)) {
            // set the owning side to null (unless already changed)
            if ($medicalFilesIllness->getIllnessId() === $this) {
                $medicalFilesIllness->setIllnessId(null);
            }
        }

        return $this;
    }
}
