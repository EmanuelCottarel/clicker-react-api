<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use App\Dto\UserDataDto;
use App\State\UserDataProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;


#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource(
    operations: [
        new Get(uriTemplate: '/user/data', output : UserDataDto::class, provider : UserDataProvider::class),
        new Post(),
        ]
)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $userName = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?float $money = null;

    #[ORM\Column]
    private ?float $clicIncome = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastConnection = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: UserWorker::class, orphanRemoval: true)]
    private Collection $userWorkers;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: UserUpgrade::class, orphanRemoval: true)]
    private Collection $userUpgrades;

    public function __construct()
    {
        $this->userWorkers = new ArrayCollection();
        $this->userUpgrades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(float $money): static
    {
        $this->money = $money;

        return $this;
    }

    public function getClicIncome(): ?float
    {
        return $this->clicIncome;
    }

    public function setClicIncome(float $clicIncome): static
    {
        $this->clicIncome = $clicIncome;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeImmutable
    {
        return $this->lastConnection;
    }

    public function setLastConnection(\DateTimeImmutable $lastConnection): static
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * @return Collection<int, UserWorker>
     */
    public function getUserWorkers(): Collection
    {
        return $this->userWorkers;
    }

    public function addUserWorker(UserWorker $userWorker): static
    {
        if (!$this->userWorkers->contains($userWorker)) {
            $this->userWorkers->add($userWorker);
            $userWorker->setIdUser($this);
        }

        return $this;
    }

    public function removeUserWorker(UserWorker $userWorker): static
    {
        if ($this->userWorkers->removeElement($userWorker)) {
            // set the owning side to null (unless already changed)
            if ($userWorker->getIdUser() === $this) {
                $userWorker->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserUpgrade>
     */
    public function getUserUpgrades(): Collection
    {
        return $this->userUpgrades;
    }

    public function addUserUpgrade(UserUpgrade $userUpgrade): static
    {
        if (!$this->userUpgrades->contains($userUpgrade)) {
            $this->userUpgrades->add($userUpgrade);
            $userUpgrade->setIdUser($this);
        }

        return $this;
    }

    public function removeUserUpgrade(UserUpgrade $userUpgrade): static
    {
        if ($this->userUpgrades->removeElement($userUpgrade)) {
            // set the owning side to null (unless already changed)
            if ($userUpgrade->getIdUser() === $this) {
                $userUpgrade->setIdUser(null);
            }
        }

        return $this;
    }
}
