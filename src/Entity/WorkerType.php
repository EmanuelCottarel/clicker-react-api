<?php

namespace App\Entity;

use App\Repository\WorkerTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;

#[ORM\Entity(repositoryClass: WorkerTypeRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ]
)]
class WorkerType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'idWorkerType', targetEntity: Worker::class, orphanRemoval: true)]
    private Collection $workers;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Worker>
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): static
    {
        if (!$this->workers->contains($worker)) {
            $this->workers->add($worker);
            $worker->setIdWorkerType($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): static
    {
        if ($this->workers->removeElement($worker)) {
            // set the owning side to null (unless already changed)
            if ($worker->getIdWorkerType() === $this) {
                $worker->setIdWorkerType(null);
            }
        }

        return $this;
    }
}
