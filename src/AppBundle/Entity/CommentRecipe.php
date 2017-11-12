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
     */
    private $cookingRecipe;

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
    public function setCookingRecipe(\AppBundle\Entity\CookingRecipe $cookingRecipe = null)
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
}
