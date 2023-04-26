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
      

    #[ORM\OneToMany(mappedBy: 'mina', targetEntity: Submina::class)]
    private Collection $submina;

    #[ORM\ManyToMany(targetEntity: MovimientoMineral::class, inversedBy: 'minas')]
    private Collection $movimientoMineral;

    public function __construct()
    {
        $this->fecha = new ArrayCollection();
        $this->submina = new ArrayCollection();
        $this->movimientoMineral = new ArrayCollection();
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
     * @return Collection<int, Submina>
     */
    public function getSubmina(): Collection
    {
        return $this->submina;
    }

    public function addSubmina(Submina $submina): self
    {
        if (!$this->submina->contains($submina)) {
            $this->submina->add($submina);
            $submina->setMina($this);
        }

        return $this;
    }

    public function removeSubmina(Submina $submina): self
    {
        if ($this->submina->removeElement($submina)) {
            // set the owning side to null (unless already changed)
            if ($submina->getMina() === $this) {
                $submina->setMina(null);
            }
        }

        return $this;
    }
}
