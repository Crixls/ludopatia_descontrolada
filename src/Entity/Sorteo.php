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


    #[ORM\OneToMany(mappedBy: 'sorteo', targetEntity: NumeroLoteria::class)]
    private Collection $numerosLoteria;

    #[ORM\OneToOne(mappedBy: 'tramiteSorteo', cascade: ['persist', 'remove'])]
    private ?Tramite $tramite = null;

    #[ORM\Column(nullable: true)]
    private ?float $precioNumero = null;

    #[ORM\OneToMany(mappedBy: 'idNumero', targetEntity: NumeroLoteria::class)]
    private Collection $numeroId;

    public function __construct()
    {
        $this->numerosLoteria = new ArrayCollection();
        $this->numeroId = new ArrayCollection();
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
   

    public function getPremio(): ?float
    {
        return $this->premio;
    }

    public function setPremio(float $premio): static
    {
        $this->premio = $premio;

        return $this;
    }


    public function getTramite(): ?Tramite
    {
        return $this->tramite;
    }

    public function setTramite(?Tramite $tramite): static
    {
        // unset the owning side of the relation if necessary
        if ($tramite === null && $this->tramite !== null) {
            $this->tramite->setTramiteSorteo(null);
        }

        // set the owning side of the relation if necessary
        if ($tramite !== null && $tramite->getTramiteSorteo() !== $this) {
            $tramite->setTramiteSorteo($this);
        }

        $this->tramite = $tramite;

        return $this;
    }

    public function getPrecioNumero(): ?float
    {
        return $this->precioNumero;
    }

    public function setPrecioNumero(?float $precioNumero): static
    {
        $this->precioNumero = $precioNumero;

        return $this;
    }

    /**
     * @return Collection<int, NumeroLoteria>
     */
    public function getNumeroId(): Collection
    {
        return $this->numeroId;
    }

    public function addNumeroId(NumeroLoteria $numeroId): static
    {
        if (!$this->numeroId->contains($numeroId)) {
            $this->numeroId->add($numeroId);
            $numeroId->setIdNumero($this);
        }

        return $this;
    }

    public function removeNumeroId(NumeroLoteria $numeroId): static
    {
        if ($this->numeroId->removeElement($numeroId)) {
            // set the owning side to null (unless already changed)
            if ($numeroId->getIdNumero() === $this) {
                $numeroId->setIdNumero(null);
            }
        }

        return $this;
    }

   

   

   
}
