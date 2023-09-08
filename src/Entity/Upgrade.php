<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Dto\UpgradeDataDto;
use App\Repository\UpgradeRepository;
use App\State\UpgradeDataProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UpgradeRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(output : UpgradeDataDto::class, provider : UpgradeDataProvider::class)
    ]
)]
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

    #[ORM\ManyToMany(targetEntity: Worker::class, inversedBy: 'upgrades')]
    private Collection $affectWorker;

    public function __construct()
    {
        $this->affectWorker = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Worker>
     */
    public function getAffectWorker(): Collection
    {
        return $this->affectWorker;
    }

    public function addAffectWorker(Worker $affectWorker): static
    {
        if (!$this->affectWorker->contains($affectWorker)) {
            $this->affectWorker->add($affectWorker);
        }

        return $this;
    }

    public function removeAffectWorker(Worker $affectWorker): static
    {
        $this->affectWorker->removeElement($affectWorker);

        return $this;
    }
}
