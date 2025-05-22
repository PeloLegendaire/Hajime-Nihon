<?php

namespace App\Entity;

use App\Repository\KanjiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KanjiRepository::class)]
class Kanji
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 2)]
    protected ?string $signe = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $onyomi = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $kunyomi = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOnyomi(): ?array
    {
        return $this->onyomi;
    }

    public function setOnyomi(?array $onyomi): static
    {
        $this->onyomi = $onyomi;

        return $this;
    }

    public function getKunyomi(): ?array
    {
        return $this->kunyomi;
    }

    public function setKunyomi(?array $kunyomi): static
    {
        $this->kunyomi = $kunyomi;

        return $this;
    }
}
