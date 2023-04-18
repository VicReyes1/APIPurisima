<?php

namespace App\Entity;

use App\Repository\AnalisisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalisisRepository::class)]
class Analisis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $ag = null;

    #[ORM\Column(nullable: true)]
    private ?float $pb = null;

    #[ORM\Column(nullable: true)]
    private ?float $zn = null;

    #[ORM\Column(nullable: true)]
    private ?float $sb = null;

    #[ORM\Column(nullable: true)]
    private ?float $cu = null;

    #[ORM\Column(nullable: true)]
    private ?float $ars = null;

    #[ORM\Column(nullable: true)]
    private ?float $fe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAg(): ?float
    {
        return $this->ag;
    }

    public function setAg(?float $ag): self
    {
        $this->ag = $ag;

        return $this;
    }

    public function getPb(): ?float
    {
        return $this->pb;
    }

    public function setPb(?float $pb): self
    {
        $this->pb = $pb;

        return $this;
    }

    public function getZn(): ?float
    {
        return $this->zn;
    }

    public function setZn(?float $zn): self
    {
        $this->zn = $zn;

        return $this;
    }

    public function getSb(): ?float
    {
        return $this->sb;
    }

    public function setSb(?float $sb): self
    {
        $this->sb = $sb;

        return $this;
    }

    public function getCu(): ?float
    {
        return $this->cu;
    }

    public function setCu(?float $cu): self
    {
        $this->cu = $cu;

        return $this;
    }

    public function getArs(): ?float
    {
        return $this->ars;
    }

    public function setArs(?float $ars): self
    {
        $this->ars = $ars;

        return $this;
    }

    public function getFe(): ?float
    {
        return $this->fe;
    }

    public function setFe(?float $fe): self
    {
        $this->fe = $fe;

        return $this;
    }
}
