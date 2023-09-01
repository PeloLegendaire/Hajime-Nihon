<?php

namespace App\Entity;

use App\Repository\HiraganaRepository;
use App\Repository\SigneRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: SigneRepository::class)]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['signe' => Signe::class, 'kanji' => Kanji::class, 'hiragana' => Hiragana::class, 'katakana' => Katakana::class])]
abstract class Signe
{

    const TYPE_MONOGRAMME = 'monogramme';
    const TYPE_DIGRAMME = 'digramme';
    const TYPE_DIACRITIQUE = 'diacritique';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 2)]
    protected ?string $signe = null;

    #[ORM\Column(length: 10)]
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
