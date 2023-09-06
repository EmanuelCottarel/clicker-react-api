<?php

namespace App\Entity;

use App\Repository\WorkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkerRepository::class)]
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

    #[ORM\ManyToMany(targetEntity: Effect::class, mappedBy: 'idWorker')]
    private Collection $effects;

    public function __construct()
    {
        $this->effects = new ArrayCollection();
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
     * @return Collection<int, Effect>
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function addEffect(Effect $effect): static
    {
        if (!$this->effects->contains($effect)) {
            $this->effects->add($effect);
            $effect->addIdWorker($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): static
    {
        if ($this->effects->removeElement($effect)) {
            $effect->removeIdWorker($this);
        }

        return $this;
    }
}
