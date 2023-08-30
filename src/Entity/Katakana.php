<?php

namespace App\Entity;

use App\Repository\KatakanaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KatakanaRepository::class)]
class Katakana extends Signe
{
    #[ORM\Column(length: 255)]
    private ?string $type = null;

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
