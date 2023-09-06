<?php

namespace App\Entity;

use App\Repository\EffectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EffectRepository::class)]
class Effect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $indice = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?EffectType $idEffectType = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Worker::class, inversedBy: 'effects')]
    private Collection $idWorker;

    public function __construct()
    {
        $this->idWorker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndice(): ?float
    {
        return $this->indice;
    }

    public function setIndice(float $indice): static
    {
        $this->indice = $indice;

        return $this;
    }

    public function getIdEffectType(): ?EffectType
    {
        return $this->idEffectType;
    }

    public function setIdEffectType(?EffectType $idEffectType): static
    {
        $this->idEffectType = $idEffectType;

        return $this;
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

    /**
     * @return Collection<int, Worker>
     */
    public function getIdWorker(): Collection
    {
        return $this->idWorker;
    }

    public function addIdWorker(Worker $idWorker): static
    {
        if (!$this->idWorker->contains($idWorker)) {
            $this->idWorker->add($idWorker);
        }

        return $this;
    }

    public function removeIdWorker(Worker $idWorker): static
    {
        $this->idWorker->removeElement($idWorker);

        return $this;
    }
}
