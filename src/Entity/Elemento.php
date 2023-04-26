<?php

namespace App\Entity;

use App\Repository\ElementoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElementoRepository::class)]
class Elemento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?float $precio = null;

    #[ORM\Column(nullable: true)]
    private ?float $precioAnterior = null;

    #[ORM\ManyToMany(targetEntity: Analisis::class, mappedBy: 'elemento')]
    private Collection $analisis;

    public function __construct()
    {
        $this->analisis = new ArrayCollection();
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

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(?float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getPrecioAnterior(): ?float
    {
        return $this->precioAnterior;
    }

    public function setPrecioAnterior(?float $precioAnterior): self
    {
        $this->precioAnterior = $precioAnterior;

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
            $analisi->addElemento($this);
        }

        return $this;
    }

    public function removeAnalisi(Analisis $analisi): self
    {
        if ($this->analisis->removeElement($analisi)) {
            $analisi->removeElemento($this);
        }

        return $this;
    }
}
