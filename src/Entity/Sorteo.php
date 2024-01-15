<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SorteoRepository::class)]
class Sorteo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $cantidadNumeros = null;

    #[ORM\Column]
    private ?float $premio = null;

    #[ORM\ManyToOne(inversedBy: 'sorteos')]
    private ?User $winner = null;

    #[ORM\OneToMany(mappedBy: 'sorteo', targetEntity: NumeroLoteria::class)]
    private Collection $numeroLoterias;

    public function __construct()
    {
        $this->numeroLoterias = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCantidadNumeros(): ?int
    {
        return $this->cantidadNumeros;
    }

    public function setCantidadNumeros(int $cantidadNumeros): static
    {
        $this->cantidadNumeros = $cantidadNumeros;

        return $this;
    }

    public function getPremio(): ?float
    {
        return $this->premio;
    }

    public function setPremio(float $premio): static
    {
        $this->premio = $premio;

        return $this;
    }

    public function getWinner(): ?User
    {
        return $this->winner;
    }

    public function setWinner(?User $winner): static
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * @return Collection<int, NumeroLoteria>
     */
    public function getNumeroLoterias(): Collection
    {
        return $this->numeroLoterias;
    }

    public function addNumeroLoteria(NumeroLoteria $numeroLoteria): static
    {
        if (!$this->numeroLoterias->contains($numeroLoteria)) {
            $this->numeroLoterias->add($numeroLoteria);
            $numeroLoteria->setSorteo($this);
        }

        return $this;
    }

    public function removeNumeroLoteria(NumeroLoteria $numeroLoteria): static
    {
        if ($this->numeroLoterias->removeElement($numeroLoteria)) {
            // set the owning side to null (unless already changed)
            if ($numeroLoteria->getSorteo() === $this) {
                $numeroLoteria->setSorteo(null);
            }
        }

        return $this;
    }

   

   
}
