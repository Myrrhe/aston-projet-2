<?php

namespace App\Entity;

use App\Repository\UserAddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserAddressRepository::class)]
class UserAddress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userAddresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'userAddresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $addressId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getAddressId(): ?Address
    {
        return $this->addressId;
    }

    public function setAddressId(?Address $addressId): self
    {
        $this->addressId = $addressId;

        return $this;
    }
}
