<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentRecipe
 *
 * @ORM\Table(name="comment_recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRecipeRepository")
 */
class CommentRecipe
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CookingRecipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cookingRecipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Set author
     *
     * @param string $author
     *
     * @return CommentRecipe
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return CommentRecipe
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
     * Set cookingRecipe
     *
     * @param \AppBundle\Entity\CookingRecipe $cookingRecipe
     *
     * @return CommentRecipe
     */
    public function setCookingRecipe(CookingRecipe $cookingRecipe)
    {
        $this->cookingRecipe = $cookingRecipe;

        return $this;
    }

    /**
     * Get cookingRecipe
     *
     * @return \AppBundle\Entity\CookingRecipe
     */
    public function getCookingRecipe()
    {
        return $this->cookingRecipe;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CommentRecipe
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
