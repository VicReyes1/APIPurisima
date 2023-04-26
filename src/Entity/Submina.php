<?php

namespace App\Entity;

use App\Repository\SubminaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubminaRepository::class)]
class Submina
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'submina')]
    private ?Mina $mina = null;

    #[ORM\ManyToMany(targetEntity: MovimientoMineral::class, inversedBy: 'subminas')]
    private Collection $movimientoMineral;

    public function __construct()
    {
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

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMina(): ?Mina
    {
        return $this->mina;
    }

    public function setMina(?Mina $mina): self
    {
        $this->mina = $mina;

        return $this;
    }

    /**
     * @return Collection<int, MovimientoMineral>
     */
    public function getMovimientoMineral(): Collection
    {
        return $this->movimientoMineral;
    }

    public function addMovimientoMineral(MovimientoMineral $movimientoMineral): self
    {
        if (!$this->movimientoMineral->contains($movimientoMineral)) {
            $this->movimientoMineral->add($movimientoMineral);
        }

        return $this;
    }

    public function removeMovimientoMineral(MovimientoMineral $movimientoMineral): self
    {
        $this->movimientoMineral->removeElement($movimientoMineral);

        return $this;
    }
}
