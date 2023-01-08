<?php

namespace App\Entity;

use App\Repository\PackRecipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRecipeRepository::class)]
class PackRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'packRecipes')]
    private ?pack $pack = null;

    #[ORM\ManyToOne(inversedBy: 'packRecipes')]
    private ?recipe $recipes = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPack(): ?pack
    {
        return $this->pack;
    }

    public function setPack(?pack $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

    public function getRecipes(): ?recipe
    {
        return $this->recipes;
    }

    public function setRecipes(?recipe $recipes): self
    {
        $this->recipes = $recipes;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
