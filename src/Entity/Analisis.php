<?php

namespace App\Entity;

use App\Repository\AnalisisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalisisRepository::class)]
class Analisis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaEnsaye = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaMuestreo = null;

    #[ORM\Column(nullable: true)]
    private ?int $turno = null;

    #[ORM\Column(nullable: true)]
    private ?float $TMS = null;

    #[ORM\ManyToOne(inversedBy: 'analisis')]
    private ?Planta $planta = null;

    #[ORM\ManyToOne(inversedBy: 'analisis')]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaEnsaye(): ?\DateTimeInterface
    {
        return $this->fechaEnsaye;
    }

    public function setFechaEnsaye(\DateTimeInterface $fechaEnsaye): self
    {
        $this->fechaEnsaye = $fechaEnsaye;

        return $this;
    }

    public function getFechaMuestreo(): ?\DateTimeInterface
    {
        return $this->fechaMuestreo;
    }

    public function setFechaMuestreo(\DateTimeInterface $fechaMuestreo): self
    {
        $this->fechaMuestreo = $fechaMuestreo;

        return $this;
    }

    public function getTurno(): ?int
    {
        return $this->turno;
    }

    public function setTurno(?int $turno): self
    {
        $this->turno = $turno;

        return $this;
    }

    public function getTMS(): ?float
    {
        return $this->TMS;
    }

    public function setTMS(?float $TMS): self
    {
        $this->TMS = $TMS;

        return $this;
    }

    public function getPlanta(): ?Planta
    {
        return $this->planta;
    }

    public function setPlanta(?Planta $planta): self
    {
        $this->planta = $planta;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
