<?php

namespace App\Entity;

use App\Repository\PlantaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantaRepository::class)]
class Planta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'planta', targetEntity: Analisis::class)]
    private Collection $analisis;

    #[ORM\OneToMany(mappedBy: 'planta', targetEntity: MovimientoMineral::class)]
    private Collection $movimientoMinerales;

    public function __construct()
    {
        $this->analisis = new ArrayCollection();
        $this->movimientoMinerales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Analisis>
     */
    public function getAnalisis(): Collection
    {
        return $this->analisis;
    }

    public function addAnalisi(Analisis $analisi): self
    {
        if (!$this->analisis->contains($analisi)) {
            $this->analisis->add($analisi);
            $analisi->setPlanta($this);
        }

        return $this;
    }

    public function removeAnalisi(Analisis $analisi): self
    {
        if ($this->analisis->removeElement($analisi)) {
            // set the owning side to null (unless already changed)
            if ($analisi->getPlanta() === $this) {
                $analisi->setPlanta(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MovimientoMineral>
     */
    public function getMovimientoMinerales(): Collection
    {
        return $this->movimientoMinerales;
    }

    public function addMovimientoMinerale(MovimientoMineral $movimientoMinerale): self
    {
        if (!$this->movimientoMinerales->contains($movimientoMinerale)) {
            $this->movimientoMinerales->add($movimientoMinerale);
            $movimientoMinerale->setPlanta($this);
        }

        return $this;
    }

    public function removeMovimientoMinerale(MovimientoMineral $movimientoMinerale): self
    {
        if ($this->movimientoMinerales->removeElement($movimientoMinerale)) {
            // set the owning side to null (unless already changed)
            if ($movimientoMinerale->getPlanta() === $this) {
                $movimientoMinerale->setPlanta(null);
            }
        }

        return $this;
    }
}
