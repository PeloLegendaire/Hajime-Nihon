<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{

    const TYPE_QUIZ = [
        'hiragana' => 'hiragana',
        'katakana' => 'katakana',
        'kanji' => 'kanji',
        'mot' => 'mot',
        'expression' => 'expression'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $libelle = null;

    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $nombreQuestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    public function getNombreQuestion(): ?int
    {
        return $this->nombreQuestion;
    }

    public function setNombreQuestion(int $nombreQuestion): static
    {
        $this->nombreQuestion = $nombreQuestion;

        return $this;
    }
}
