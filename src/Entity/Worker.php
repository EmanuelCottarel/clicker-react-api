<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: WorkerRepository::class)]
#[ApiResource()]
class Worker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $basePrice = null;

    #[ORM\Column]
    private ?float $baseIncome = null;

    #[ORM\ManyToOne(inversedBy: 'workers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WorkerType $idWorkerType = null;

    #[ORM\ManyToMany(targetEntity: Upgrade::class, mappedBy: 'affectWorker')]
    private Collection $upgrades;

    public function __construct()
    {
        $this->upgrades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->basePrice;
    }

    public function setBasePrice(int $basePrice): static
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getBaseIncome(): ?float
    {
        return $this->baseIncome;
    }

    public function setBaseIncome(float $baseIncome): static
    {
        $this->baseIncome = $baseIncome;

        return $this;
    }

    public function getIdWorkerType(): ?WorkerType
    {
        return $this->idWorkerType;
    }

    public function setIdWorkerType(?WorkerType $idWorkerType): static
    {
        $this->idWorkerType = $idWorkerType;

        return $this;
    }

    /**
     * @return Collection<int, Upgrade>
     */
    public function getUpgrades(): Collection
    {
        return $this->upgrades;
    }

    public function addUpgrade(Upgrade $upgrade): static
    {
        if (!$this->upgrades->contains($upgrade)) {
            $this->upgrades->add($upgrade);
            $upgrade->addAffectWorker($this);
        }

        return $this;
    }

    public function removeUpgrade(Upgrade $upgrade): static
    {
        if ($this->upgrades->removeElement($upgrade)) {
            $upgrade->removeAffectWorker($this);
        }

        return $this;
    }
}
