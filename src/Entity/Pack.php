<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'packs')]
    private ?recipe $recipes = null;

    #[ORM\OneToMany(mappedBy: 'pack', targetEntity: PackRecipe::class)]
    private Collection $packRecipes;

    public function __construct()
    {
        $this->packRecipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    /**
     * @return Collection<int, PackRecipe>
     */
    public function getPackRecipes(): Collection
    {
        return $this->packRecipes;
    }

    public function addPackRecipe(PackRecipe $packRecipe): self
    {
        if (!$this->packRecipes->contains($packRecipe)) {
            $this->packRecipes->add($packRecipe);
            $packRecipe->setPack($this);
        }

        return $this;
    }

    public function removePackRecipe(PackRecipe $packRecipe): self
    {
        if ($this->packRecipes->removeElement($packRecipe)) {
            // set the owning side to null (unless already changed)
            if ($packRecipe->getPack() === $this) {
                $packRecipe->setPack(null);
            }
        }

        return $this;
    }
}
