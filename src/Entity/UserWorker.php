<?php

namespace App\Entity;

use App\Repository\UserWorkerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Dto\UserWorkerPatchDto;

#[ORM\Entity(repositoryClass: UserWorkerRepository::class)]
#[ApiResource(
    operations: [
    new Post(uriTemplate: '/user/workers'),
    new Patch(uriTemplate: '/user/workers/{id}')//, input: UserWorkerPatchDto::class)
    ]
)]
class UserWorker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $calculatedIncome = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Worker $idWorker = null;

    #[ORM\ManyToOne(inversedBy: 'userWorkers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCalculatedIncome(): ?float
    {
        return $this->calculatedIncome;
    }

    public function setCalculatedIncome(float $calculatedIncome): static
    {
        $this->calculatedIncome = $calculatedIncome;

        return $this;
    }

    public function getIdWorker(): ?Worker
    {
        return $this->idWorker;
    }

    public function setIdWorker(?Worker $idWorker): static
    {
        $this->idWorker = $idWorker;

        return $this;
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
}
