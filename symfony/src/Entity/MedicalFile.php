<?php

namespace App\Entity;

use App\Repository\MedicalFileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalFileRepository::class)]
class MedicalFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\OneToOne(inversedBy: 'medicalFile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patientId = null;

    #[ORM\ManyToMany(targetEntity: Allergy::class, inversedBy: 'medicalFiles')]
    private Collection $allergies;

    #[ORM\OneToMany(mappedBy: 'medicalFileId', targetEntity: MedicalFileIllness::class)]
    private Collection $medicalFilesIllnesses;

    public function __construct()
    {
        $this->allergies = new ArrayCollection();
        $this->medicalFilesIllnesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPatientId(): ?Patient
    {
        return $this->patientId;
    }

    public function setPatientId(Patient $patientId): self
    {
        $this->patientId = $patientId;

        return $this;
    }

    /**
     * @return Collection<int, Allergy>
     */
    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergy(Allergy $allergy): self
    {
        if (!$this->allergies->contains($allergy)) {
            $this->allergies->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergy $allergy): self
    {
        $this->allergies->removeElement($allergy);

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
            $medicalFilesIllness->setMedicalFileId($this);
        }

        return $this;
    }

    public function removeMedicalFilesIllness(MedicalFileIllness $medicalFilesIllness): self
    {
        if ($this->medicalFilesIllnesses->removeElement($medicalFilesIllness)) {
            // set the owning side to null (unless already changed)
            if ($medicalFilesIllness->getMedicalFileId() === $this) {
                $medicalFilesIllness->setMedicalFileId(null);
            }
        }

        return $this;
    }
}
