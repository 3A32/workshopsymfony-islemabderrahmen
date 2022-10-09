<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]

    #[ORM\Column(length: 255)]
    private ?String $reference = null;

    /**
     * @return String|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param String|null $reference
     */
    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    #[ORM\Column(length: 255)]
    private ?string $titre = null;



    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}
