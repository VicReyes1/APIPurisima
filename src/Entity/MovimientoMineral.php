<?php

namespace App\Entity;

use App\Repository\MovimientoMineralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?float $trituradas = null;

    #[ORM\Column(nullable: true)]
    private ?float $humedad = null;

    #[ORM\ManyToOne(inversedBy: 'movimientoMinerales')]
    private ?Planta $planta = null;

    #[ORM\ManyToOne(inversedBy: 'movimientoMineralR')]
    private ?Usuario $usuario = null;

    #[ORM\ManyToMany(targetEntity: Mina::class, mappedBy: 'movimientoMineral')]
    private Collection $minas;

    #[ORM\ManyToMany(targetEntity: Submina::class, mappedBy: 'movimientoMineral')]
    private Collection $subminas;

    public function __construct()
    {
        $this->minas = new ArrayCollection();
        $this->subminas = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Submina>
     */
    public function getSubminas(): Collection
    {
        return $this->subminas;
    }

    public function addSubmina(Submina $submina): self
    {
        if (!$this->subminas->contains($submina)) {
            $this->subminas->add($submina);
            $submina->addMovimientoMineral($this);
        }

        return $this;
    }

    public function removeSubmina(Submina $submina): self
    {
        if ($this->subminas->removeElement($submina)) {
            $submina->removeMovimientoMineral($this);
        }

        return $this;
    }

}
