<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\ResetDataController;
use App\Dto\UserDataDto;
use App\Repository\UserRepository;
use App\State\UserDataProvider;
use App\State\UserHashPasswordProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Get(
            uriTemplate: '/user/reset',
            controller: ResetDataController::class),
        new Get(
            uriTemplate: '/user/data',
            output: UserDataDto::class,
            provider: UserDataProvider::class),
        new Post(
            uriTemplate: '/register',
            processor: UserHashPasswordProcessor::class),
        new Patch(
            processor: UserHashPasswordProcessor::class),
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    private ?string $username = null;

    #[ORM\Column]
    private ?float $money = null;

    #[ORM\Column]
    private ?float $clicIncome = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastConnection = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserWorker::class, cascade: ["persist"], orphanRemoval: true)]
    private Collection $userWorkers;


    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    private ?string $plainPassword = null;

    #[ORM\ManyToMany(targetEntity: Upgrade::class, inversedBy: 'users')]
    private Collection $upgrades;

    public function __construct()
    {
        $this->setMoney();
        $this->setClicIncome();
        $this->setLastConnection();
        $this->setRoles();
        $this->userWorkers = new ArrayCollection();
        $this->upgrades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles = []): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        // TODO : hash password
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(float $money = 0): static
    {
        $this->money = $money;

        return $this;
    }

    public function getClicIncome(): ?float
    {
        return $this->clicIncome;
    }

    public function setClicIncome(float $clicIncome = 1): static
    {
        $this->clicIncome = $clicIncome;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeImmutable
    {
        return $this->lastConnection;
    }

    public function setLastConnection(): static
    {
        $this->lastConnection = new \DateTimeImmutable();

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

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
        }

        return $this;
    }

    public function removeUpgrade(Upgrade $upgrade): static
    {
        $this->upgrades->removeElement($upgrade);

        return $this;
    }
}
