<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column(length: 255)]
    private ?string $floor = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Block $blockId = null;

    #[ORM\OneToMany(mappedBy: 'roomId', targetEntity: RoomEquipment::class)]
    private Collection $roomsEquipments;

    #[ORM\OneToMany(mappedBy: 'roomId', targetEntity: PatientRoom::class)]
    private Collection $patientsRooms;

    #[ORM\OneToMany(mappedBy: 'roomId', targetEntity: Appointment::class)]
    private Collection $appointments;

    public function __construct()
    {
        $this->roomsEquipments = new ArrayCollection();
        $this->patientsRooms = new ArrayCollection();
        $this->appointments = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getBlockId(): ?Block
    {
        return $this->blockId;
    }

    public function setBlockId(?Block $blockId): self
    {
        $this->blockId = $blockId;

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
            $roomsEquipment->setRoomId($this);
        }

        return $this;
    }

    public function removeRoomsEquipment(RoomEquipment $roomsEquipment): self
    {
        if ($this->roomsEquipments->removeElement($roomsEquipment)) {
            // set the owning side to null (unless already changed)
            if ($roomsEquipment->getRoomId() === $this) {
                $roomsEquipment->setRoomId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PatientRoom>
     */
    public function getPatientsRooms(): Collection
    {
        return $this->patientsRooms;
    }

    public function addPatientsRoom(PatientRoom $patientsRoom): self
    {
        if (!$this->patientsRooms->contains($patientsRoom)) {
            $this->patientsRooms->add($patientsRoom);
            $patientsRoom->setRoomId($this);
        }

        return $this;
    }

    public function removePatientsRoom(PatientRoom $patientsRoom): self
    {
        if ($this->patientsRooms->removeElement($patientsRoom)) {
            // set the owning side to null (unless already changed)
            if ($patientsRoom->getRoomId() === $this) {
                $patientsRoom->setRoomId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->setRoomId($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getRoomId() === $this) {
                $appointment->setRoomId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
