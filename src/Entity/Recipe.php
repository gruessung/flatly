<?php

namespace App\Entity;


/**
 * 	"@context": "http://schema.org/",
"@type": "Recipe",
"name": "Zwiebelbrot",
"image": [
""
],
"recipeCategory": "Backen, Brot",
"recipeCuisine": "Deutsch",
"prepTime": "PT5M",
"cookTime": "PT55M",
"totalTime": "PT60M",
"description": "Einfaches Zwiebelbrot",
"recipeIngredient": [
"500g Dinkelmehl",
"450ml lauwarmes Wasser",
"1 Block Hefe",
"3EL Apfelessig"
],
"recipeInstructions": [
{
"@type": "HowToStep",
"name": "Teig herstellen",
"text": "Alle Zutaten zusammen in eine Schüssel geben, dabei die Hefe zerbröseln. Alles mit einer Handrührmaschine vermengen."
},
{
"@type": "HowToStep",
"name": "Backen",
"text": "Den Teig in eine Backform geben und bei 200°C Ober- / Unterhitze in einen nicht vorgeheizten Ofen für 55 Minuten backen."
}
]
 */

class Recipe
{

    private string $name;
    private string $description;
    private array $image;
    private array $recipeCategory;
    private string $recipeCuisine;
    private string $prepTime;
    private string $cookTime;
    private string $totalTime;
    private array $recipeIngredient;
    private array $recipeInstructions;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getImage(): array
    {
        return $this->image;
    }

    /**
     * @param array $image
     */
    public function setImage(array $image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getRecipeCategory(): array
    {
        return $this->recipeCategory;
    }

    /**
     * @param array $recipeCategory
     */
    public function setRecipeCategory(array $recipeCategory): void
    {
        $this->recipeCategory = $recipeCategory;
    }

    /**
     * @return string
     */
    public function getRecipeCuisine(): string
    {
        return $this->recipeCuisine;
    }

    /**
     * @param string $recipeCuisine
     */
    public function setRecipeCuisine(string $recipeCuisine): void
    {
        $this->recipeCuisine = $recipeCuisine;
    }

    /**
     * @return string
     */
    public function getPrepTime(): string
    {
        return $this->prepTime;
    }

    /**
     * @param string $prepTime
     */
    public function setPrepTime(string $prepTime): void
    {
        $this->prepTime = $prepTime;
    }

    /**
     * @return string
     */
    public function getCookTime(): string
    {
        return $this->cookTime;
    }

    /**
     * @param string $cookTime
     */
    public function setCookTime(string $cookTime): void
    {
        $this->cookTime = $cookTime;
    }

    /**
     * @return string
     */
    public function getTotalTime(): string
    {
        return $this->totalTime;
    }

    /**
     * @param string $totalTime
     */
    public function setTotalTime(string $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    /**
     * @return array
     */
    public function getRecipeIngredient(): array
    {
        return $this->recipeIngredient;
    }

    /**
     * @param array $recipeIngredient
     */
    public function setRecipeIngredient(array $recipeIngredient): void
    {
        $this->recipeIngredient = $recipeIngredient;
    }

    /**
     * @return array
     */
    public function getRecipeInstructions(): array
    {
        return $this->recipeInstructions;
    }

    /**
     * @param array $recipeInstructions
     */
    public function setRecipeInstructions(array $recipeInstructions): void
    {
        $this->recipeInstructions = $recipeInstructions;
    }











}