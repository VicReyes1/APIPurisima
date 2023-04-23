<?php

namespace App\Entity;

use App\Repository\MinaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MinaRepository::class)]
class Mina
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Concentrado::class, inversedBy: 'minas')]
    private Collection $fecha;

    public function __construct()
    {
        $this->fecha = new ArrayCollection();
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
     * @return Collection<int, Concentrado>
     */
    public function getFecha(): Collection
    {
        return $this->fecha;
    }

    public function addFecha(Concentrado $fecha): self
    {
        if (!$this->fecha->contains($fecha)) {
            $this->fecha->add($fecha);
        }

        return $this;
    }

    public function removeFecha(Concentrado $fecha): self
    {
        $this->fecha->removeElement($fecha);

        return $this;
    }
}
