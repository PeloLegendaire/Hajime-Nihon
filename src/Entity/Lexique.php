<?php

namespace App\Entity;

use App\Repository\LexiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LexiqueRepository::class)]
class Lexique
{

    const TYPE_MOT = 'mot';
    const TYPE_EXPRESSION = 'expression';
    const LEXIQUE_TYPES = [
        Lexique::TYPE_MOT => Lexique::TYPE_MOT,
        Lexique::TYPE_EXPRESSION => Lexique::TYPE_EXPRESSION
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $kanji = null;

    #[ORM\Column(length: 255)]
    private ?string $romaji = null;

    #[ORM\Column(length: 255)]
    private ?string $traduction = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKanji(): ?string
    {
        return $this->kanji;
    }

    public function setKanji(string $kanji): static
    {
        $this->kanji = $kanji;

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

    public function getTraduction(): ?string
    {
        return $this->traduction;
    }

    public function setTraduction(string $traduction): static
    {
        $this->traduction = $traduction;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
