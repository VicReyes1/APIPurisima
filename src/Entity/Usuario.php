<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]

class Usuario 
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidoP = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidoM = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $cel = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ultimaConexion = null;

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    private ?Rol $rol = null;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Analisis::class)]
    private Collection $analisis;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: MovimientoMineral::class)]
    private Collection $movimientoMineralR;

    public function __construct()
    {
        $this->analisis = new ArrayCollection();
        $this->movimientoMineralR = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getApellidoP(): ?string
    {
        return $this->apellidoP;
    }

    public function setApellidoP(string $apellidoP): self
    {
        $this->apellidoP = $apellidoP;

        return $this;
    }

    public function getApellidoM(): ?string
    {
        return $this->apellidoM;
    }

    public function setApellidoM(string $apellidoM): self
    {
        $this->apellidoM = $apellidoM;

        return $this;
    }

    public function getCel(): ?string
    {
        return $this->cel;
    }

    public function setCel(?string $cel): self
    {
        $this->cel = $cel;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUltimaConexion(): ?\DateTimeInterface
    {
        return $this->ultimaConexion;
    }

    public function setUltimaConexion(?\DateTimeInterface $ultimaConexion): self
    {
        $this->ultimaConexion = $ultimaConexion;

        return $this;
    }

    public function getRol(): ?Rol
    {
        return $this->rol;
    }

    public function setRol(?Rol $rol): self
    {
        $this->rol = $rol;

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
            $analisi->setUsuario($this);
        }

        return $this;
    }

    public function removeAnalisi(Analisis $analisi): self
    {
        if ($this->analisis->removeElement($analisi)) {
            // set the owning side to null (unless already changed)
            if ($analisi->getUsuario() === $this) {
                $analisi->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MovimientoMineral>
     */
    public function getMovimientoMineralR(): Collection
    {
        return $this->movimientoMineralR;
    }

    public function addMovimientoMineralR(MovimientoMineral $movimientoMineralR): self
    {
        if (!$this->movimientoMineralR->contains($movimientoMineralR)) {
            $this->movimientoMineralR->add($movimientoMineralR);
            $movimientoMineralR->setUsuario($this);
        }

        return $this;
    }

    public function removeMovimientoMineralR(MovimientoMineral $movimientoMineralR): self
    {
        if ($this->movimientoMineralR->removeElement($movimientoMineralR)) {
            // set the owning side to null (unless already changed)
            if ($movimientoMineralR->getUsuario() === $this) {
                $movimientoMineralR->setUsuario(null);
            }
        }

        return $this;
    }
}
