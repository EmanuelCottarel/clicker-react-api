<?php

namespace App\Entity;

use App\Repository\UpgradeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UpgradeRepository::class)]
class Upgrade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $upgradeName = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $upgradeDesc = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Effect $idEffect = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpgradeName(): ?string
    {
        return $this->upgradeName;
    }

    public function setUpgradeName(string $upgradeName): static
    {
        $this->upgradeName = $upgradeName;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getUpgradeDesc(): ?string
    {
        return $this->upgradeDesc;
    }

    public function setUpgradeDesc(string $upgradeDesc): static
    {
        $this->upgradeDesc = $upgradeDesc;

        return $this;
    }

    public function getIdEffect(): ?Effect
    {
        return $this->idEffect;
    }

    public function setIdEffect(?Effect $idEffect): static
    {
        $this->idEffect = $idEffect;

        return $this;
    }
}
