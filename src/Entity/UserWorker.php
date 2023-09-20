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
    private ?Worker $worker = null;

    #[ORM\ManyToOne(inversedBy: 'userWorkers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function getWorker(): ?Worker
    {
        return $this->worker;
    }

    public function setWorker(?Worker $worker): static
    {
        $this->worker = $worker;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
