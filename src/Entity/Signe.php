<?php

namespace App\Entity;

use App\Repository\SigneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SigneRepository::class)]
abstract class Signe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 2)]
    protected ?string $signe = null;

    #[ORM\Column(length: 5)]
    protected ?string $romaji = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSigne(): ?string
    {
        return $this->signe;
    }

    public function setSigne(string $signe): static
    {
        $this->signe = $signe;

        return $this;
    }

    public function getRomaji(): ?string
    {
        return $this->romaji;
    }

    public function setRomaji(string $romaji): static
    {
        $this->romaji = $romaji;

        return $this;
    }
}
