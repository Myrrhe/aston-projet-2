<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $totalQuantity = null;

    #[ORM\OneToMany(mappedBy: 'equipmentId', targetEntity: RoomEquipment::class)]
    private Collection $roomsEquipments;

    public function __construct()
    {
        $this->roomsEquipments = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(int $totalQuantity): self
    {
        $this->totalQuantity = $totalQuantity;

        return $this;
    }

    /**
     * @return Collection<int, RoomEquipment>
     */
    public function getRoomsEquipments(): Collection
    {
        return $this->roomsEquipments;
    }

    public function addRoomsEquipment(RoomEquipment $roomsEquipment): self
    {
        if (!$this->roomsEquipments->contains($roomsEquipment)) {
            $this->roomsEquipments->add($roomsEquipment);
            $roomsEquipment->setEquipmentId($this);
        }

        return $this;
    }

    public function removeRoomsEquipment(RoomEquipment $roomsEquipment): self
    {
        if ($this->roomsEquipments->removeElement($roomsEquipment)) {
            // set the owning side to null (unless already changed)
            if ($roomsEquipment->getEquipmentId() === $this) {
                $roomsEquipment->setEquipmentId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
