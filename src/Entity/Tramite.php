<?php

namespace App\Entity;

use App\Repository\TramiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TramiteRepository::class)]
class Tramite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $tipo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'tramites')]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'tramite', cascade: ['persist', 'remove'])]
    private ?Sorteo $tramiteSorteo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): static
    {
        $this->tipo = $tipo;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTramiteSorteo(): ?Sorteo
    {
        return $this->tramiteSorteo;
    }

    public function setTramiteSorteo(?Sorteo $tramiteSorteo): static
    {
        $this->tramiteSorteo = $tramiteSorteo;

        return $this;
    }
}
