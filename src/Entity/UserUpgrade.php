<?php

namespace App\Entity;

use App\Repository\UserUpgradeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: UserUpgradeRepository::class)]
#[ApiResource(
    operations: [
        new Post(uriTemplate: '/user/upgrades'),
        ]
)]
class UserUpgrade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userUpgrades')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Upgrade $idUpgrade = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
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
