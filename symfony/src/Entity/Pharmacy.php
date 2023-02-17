<?php

namespace App\Entity;

use App\Repository\PharmacyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PharmacyRepository::class)]
class Pharmacy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $head = null;

    #[ORM\OneToMany(mappedBy: 'pharmacyId', targetEntity: PharmacyMedication::class)]
    private Collection $pharmaciesMedications;

    public function __construct()
    {
        $this->pharmaciesMedications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getHead(): ?string
    {
        return $this->head;
    }

    public function setHead(?string $head): self
    {
        $this->head = $head;

        return $this;
    }

    /**
     * @return Collection<int, PharmacyMedication>
     */
    public function getPharmaciesMedications(): Collection
    {
        return $this->pharmaciesMedications;
    }

    public function addPharmaciesMedication(PharmacyMedication $pharmaciesMedication): self
    {
        if (!$this->pharmaciesMedications->contains($pharmaciesMedication)) {
            $this->pharmaciesMedications->add($pharmaciesMedication);
            $pharmaciesMedication->setPharmacyId($this);
        }

        return $this;
    }

    public function removePharmaciesMedication(PharmacyMedication $pharmaciesMedication): self
    {
        if ($this->pharmaciesMedications->removeElement($pharmaciesMedication)) {
            // set the owning side to null (unless already changed)
            if ($pharmaciesMedication->getPharmacyId() === $this) {
                $pharmaciesMedication->setPharmacyId(null);
            }
        }

        return $this;
    }
}
