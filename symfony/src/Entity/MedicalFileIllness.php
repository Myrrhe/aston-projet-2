<?php

namespace App\Entity;

use App\Repository\MedicalFileIllnessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalFileIllnessRepository::class)]
class MedicalFileIllness
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'medicalFilesIllnesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MedicalFile $medicalFileId = null;

    #[ORM\ManyToOne(inversedBy: 'medicalFilesIllnesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Illness $illnessId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMedicalFileId(): ?MedicalFile
    {
        return $this->medicalFileId;
    }

    public function setMedicalFileId(?MedicalFile $medicalFileId): self
    {
        $this->medicalFileId = $medicalFileId;

        return $this;
    }

    public function getIllnessId(): ?Illness
    {
        return $this->illnessId;
    }

    public function setIllnessId(?Illness $illnessId): self
    {
        $this->illnessId = $illnessId;

        return $this;
    }
}
