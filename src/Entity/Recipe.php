<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'recipes', targetEntity: Ingredient::class)]
    private Collection $ingredients;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeIngredient::class)]
    private Collection $recipeIngredients;

    #[ORM\OneToMany(mappedBy: 'recipes', targetEntity: Pack::class)]
    private Collection $packs;

    #[ORM\OneToMany(mappedBy: 'recipes', targetEntity: PackRecipe::class)]
    private Collection $packRecipes;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->recipeIngredients = new ArrayCollection();
        $this->packs = new ArrayCollection();
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

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecipes($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipes() === $this) {
                $ingredient->setRecipes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecipeIngredient>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pack>
     */
    public function getPacks(): Collection
    {
        return $this->packs;
    }

    public function addPack(Pack $pack): self
    {
        if (!$this->packs->contains($pack)) {
            $this->packs->add($pack);
            $pack->setRecipes($this);
        }

        return $this;
    }

    public function removePack(Pack $pack): self
    {
        if ($this->packs->removeElement($pack)) {
            // set the owning side to null (unless already changed)
            if ($pack->getRecipes() === $this) {
                $pack->setRecipes(null);
            }
        }

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
            $packRecipe->setRecipes($this);
        }

        return $this;
    }

    public function removePackRecipe(PackRecipe $packRecipe): self
    {
        if ($this->packRecipes->removeElement($packRecipe)) {
            // set the owning side to null (unless already changed)
            if ($packRecipe->getRecipes() === $this) {
                $packRecipe->setRecipes(null);
            }
        }

        return $this;
    }
}
