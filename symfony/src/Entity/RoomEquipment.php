<?php

namespace App\Entity;

use App\Repository\RoomEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomEquipmentRepository::class)]
class RoomEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roomsEquipments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $roomId = null;

    #[ORM\ManyToOne(inversedBy: 'roomsEquipments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipment $equipmentId = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?Room
    {
        return $this->roomId;
    }

    public function setRoomId(?Room $roomId): self
    {
        $this->roomId = $roomId;

        return $this;
    }

    public function getEquipmentId(): ?Equipment
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(?Equipment $equipmentId): self
    {
        $this->equipmentId = $equipmentId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function __toString()
    {
        return $this->roomId . ' ' . $this->equipmentId;
    }
}
