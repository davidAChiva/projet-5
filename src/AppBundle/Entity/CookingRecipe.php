<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CookingRecipe
 *
 * @ORM\Table(name="cooking_recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CookingRecipeRepository")
 * @UniqueEntity(fields="name", message="Le nom de la recette existe déjà")
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
     * @Assert\Length(
     *      min = 3,
     *      max = 35,
     *      minMessage = "Le nom de la recette doit contenir au moins {{ limit }} caractéres",
     *      maxMessage = "Le nom de la recette doit pas dépasser {{ limit }} caractéres"
     * )
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(unique=true)
     */
    private $slug;
    
    /**
     * @var int
     *
     * @ORM\Column(name="preparation_time", type="integer")
     *     @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} doit être de type numérique"
     * )
     */
    private $preparationTime;

    /**
     * @var string
     *
     * @ORM\Column(name="cooking_time", type="integer")
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} doit être de type numérique"
     * )
     */
    private $cookingTime;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     * @Assert\DateTime()
     */
    private $dateCreation;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean")
     * @Assert\Type(
     *     type="bool",
     *     message="La valeur {{ value }} doit être vrai où faux"
     * )
     */
    private $published = true;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Ingredient", cascade={"persist"})
     * @ORM\JoinTable(name="cooking_recipe_ingredient")
     * @Assert\Valid()
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SpecialtyCountry")
     * @ORM\joinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $specialtyCountry;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\PartOfMenu")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $partOfMenu;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $image;

    /**
     * @ORM\Column(name="nb_visit", type="integer")
     */
    private $nbVisit = 0;

    /**
     * @ORM\Column(name="average_note", type="float", nullable=true)
     */
    private $averageNotes = null;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function increaseNbVisit()
    {
        $this->nbVisit++;
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

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return CookingRecipe
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set nbVisit
     *
     * @param integer $nbVisit
     *
     * @return CookingRecipe
     */
    public function setNbVisit($nbVisit)
    {
        $this->nbVisit = $nbVisit;

        return $this;
    }

    /**
     * Get nbVisit
     *
     * @return integer
     */
    public function getNbVisit()
    {
        return $this->nbVisit;
    }

    /**
     * Set averageNotes
     *
     * @param integer $averageNotes
     *
     * @return CookingRecipe
     */
    public function setAverageNotes($averageNotes)
    {
        $this->averageNotes = $averageNotes;

        return $this;
    }

    /**
     * Get averageNotes
     *
     * @return integer
     */
    public function getAverageNotes()
    {
        return $this->averageNotes;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return CookingRecipe
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
