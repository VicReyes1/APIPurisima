<?php

namespace App\Entity;

use App\Repository\MovimientoMineralRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovimientoMineralRepository::class)]
class MovimientoMineral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(nullable: true)]
    private ?float $acarrero = null;

    #[ORM\Column(nullable: true)]
    private ?float $trituradas = null;

    #[ORM\Column(nullable: true)]
    private ?float $humedad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getAcarrero(): ?float
    {
        return $this->acarrero;
    }

    public function setAcarrero(?float $acarrero): self
    {
        $this->acarrero = $acarrero;

        return $this;
    }

    public function getTrituradas(): ?float
    {
        return $this->trituradas;
    }

    public function setTrituradas(?float $trituradas): self
    {
        $this->trituradas = $trituradas;

        return $this;
    }

    public function getHumedad(): ?float
    {
        return $this->humedad;
    }

    public function setHumedad(?float $humedad): self
    {
        $this->humedad = $humedad;

        return $this;
    }
}
