<?php

namespace App\Entity;

use App\Repository\KanjiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KanjiRepository::class)]
class Kanji extends Signe
{
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $traduction = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTraduction(): ?string
    {
        return $this->traduction;
    }

    public function setTraduction(string $traduction): static
    {
        $this->traduction = $traduction;

        return $this;
    }
}
