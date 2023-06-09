<?php

namespace App\Entity;

use App\Repository\ConcentradoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcentradoRepository::class)]
class Concentrado
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

    #[ORM\ManyToMany(targetEntity: Mina::class, mappedBy: 'fecha')]
    private Collection $minas;

    public function __construct()
    {
        $this->minas = new ArrayCollection();
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
     * @return Collection<int, Mina>
     */
    public function getMinas(): Collection
    {
        return $this->minas;
    }

    public function addMina(Mina $mina): self
    {
        if (!$this->minas->contains($mina)) {
            $this->minas->add($mina);
            $mina->addFecha($this);
        }

        return $this;
    }

    public function removeMina(Mina $mina): self
    {
        if ($this->minas->removeElement($mina)) {
            $mina->removeFecha($this);
        }

        return $this;
    }
}
