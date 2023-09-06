<?php

namespace App\Entity;

use App\Repository\UserUpgradeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserUpgradeRepository::class)]
class UserUpgrade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userUpgrades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $idUser = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Upgrade $idUpgrade = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdUpgrade(): ?Upgrade
    {
        return $this->idUpgrade;
    }

    public function setIdUpgrade(?Upgrade $idUpgrade): static
    {
        $this->idUpgrade = $idUpgrade;

        return $this;
    }
}
