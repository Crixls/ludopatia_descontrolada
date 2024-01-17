<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?float $saldo = null;

    #[ORM\Column]
    private ?int $rol = null;

    #[ORM\ManyToOne(inversedBy: 'winner')]
    private ?Sorteo $sorteo = null;

    #[ORM\OneToMany(mappedBy: 'winner', targetEntity: Sorteo::class)]
    private Collection $sorteos;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Tramite::class)]
    private Collection $tramites;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: NumeroLoteria::class)]
    private Collection $numeros;

    public function __construct()
    {
        $this->sorteos = new ArrayCollection();
        $this->tramites = new ArrayCollection();
        $this->numeros = new ArrayCollection();
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
        return (string) $this->username;
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

    public function setRoles(array $roles): static
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
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): static
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getRol(): ?int
    {
        return $this->rol;
    }

    public function setRol(int $rol): static
    {
        $this->rol = $rol;

        return $this;
    }

    public function getSorteo(): ?Sorteo
    {
        return $this->sorteo;
    }

    public function setSorteo(?Sorteo $sorteo): static
    {
        $this->sorteo = $sorteo;

        return $this;
    }

    /**
     * @return Collection<int, Sorteo>
     */
    public function getSorteos(): Collection
    {
        return $this->sorteos;
    }

    public function addSorteo(Sorteo $sorteo): static
    {
        if (!$this->sorteos->contains($sorteo)) {
            $this->sorteos->add($sorteo);
            $sorteo->setWinner($this);
        }

        return $this;
    }

    public function removeSorteo(Sorteo $sorteo): static
    {
        if ($this->sorteos->removeElement($sorteo)) {
            // set the owning side to null (unless already changed)
            if ($sorteo->getWinner() === $this) {
                $sorteo->setWinner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tramite>
     */
    public function getTramites(): Collection
    {
        return $this->tramites;
    }

    public function addTramite(Tramite $tramite): static
    {
        if (!$this->tramites->contains($tramite)) {
            $this->tramites->add($tramite);
            $tramite->setUser($this);
        }

        return $this;
    }

    public function removeTramite(Tramite $tramite): static
    {
        if ($this->tramites->removeElement($tramite)) {
            // set the owning side to null (unless already changed)
            if ($tramite->getUser() === $this) {
                $tramite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NumeroLoteria>
     */
    public function getNumeros(): Collection
    {
        return $this->numeros;
    }

    public function addNumero(NumeroLoteria $numero): static
    {
        if (!$this->numeros->contains($numero)) {
            $this->numeros->add($numero);
            $numero->setUser($this);
        }

        return $this;
    }

    public function removeNumero(NumeroLoteria $numero): static
    {
        if ($this->numeros->removeElement($numero)) {
            // set the owning side to null (unless already changed)
            if ($numero->getUser() === $this) {
                $numero->setUser(null);
            }
        }

        return $this;
    }
}
