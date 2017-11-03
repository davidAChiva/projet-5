<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CookingRecipe
 *
 * @ORM\Table(name="cooking_recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CookingRecipeRepository")
 */
class CookingRecipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="preparation_time", type="integer")
     */
    private $preparationTime;

    /**
     * @var string
     *
     * @ORM\Column(name="cooking_time", type="string", length=255)
     */
    private $cookingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ingredient", cascade={"persist"})
     * @ORM\JoinTable(name="cooking_recipe_ingredient")
     */
    private $ingredients;

    /**
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\SpecialtyCountry")
     */
    private $specialtyCountry;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PartOfMenu")
     */
    private $partOfMenu;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CookingRecipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set preparationTime
     *
     * @param integer $preparationTime
     *
     * @return CookingRecipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return int
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set cookingTime
     *
     * @param string $cookingTime
     *
     * @return CookingRecipe
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * Get cookingTime
     *
     * @return string
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return CookingRecipe
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return CookingRecipe
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return CookingRecipe
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     *
     * @return CookingRecipe
     */
    public function addIngredient(\AppBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \AppBundle\Entity\Ingredient $ingredient
     */
    public function removeIngredient(\AppBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set specialtyCountry
     *
     * @param \AppBundle\Entity\SpecialtyCountry $specialtyCountry
     *
     * @return CookingRecipe
     */
    public function setSpecialtyCountry(\AppBundle\Entity\SpecialtyCountry $specialtyCountry = null)
    {
        $this->specialtyCountry = $specialtyCountry;

        return $this;
    }

    /**
     * Get specialtyCountry
     *
     * @return \AppBundle\Entity\SpecialtyCountry
     */
    public function getSpecialtyCountry()
    {
        return $this->specialtyCountry;
    }

    /**
     * Set partOfMenu
     *
     * @param \AppBundle\Entity\PartOfMenu $partOfMenu
     *
     * @return CookingRecipe
     */
    public function setPartOfMenu(\AppBundle\Entity\PartOfMenu $partOfMenu = null)
    {
        $this->partOfMenu = $partOfMenu;

        return $this;
    }

    /**
     * Get partOfMenu
     *
     * @return \AppBundle\Entity\PartOfMenu
     */
    public function getPartOfMenu()
    {
        return $this->partOfMenu;
    }

    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return CookingRecipe
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
