<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
}
