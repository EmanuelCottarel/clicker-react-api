<?php

namespace App\Entity;

use App\Repository\UserWorkerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserWorkerRepository::class)]
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
    private ?Users $idUser = null;

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

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }
}
