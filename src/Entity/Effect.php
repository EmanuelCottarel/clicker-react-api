<?php

namespace App\Entity;

use App\Repository\EffectRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;

#[ORM\Entity(repositoryClass: EffectRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ]
)]
class Effect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $indice = null;

    #[ORM\ManyToOne(cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EffectType $idEffectType = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
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
}
