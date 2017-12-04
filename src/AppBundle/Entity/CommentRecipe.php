<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     * @Assert\Range(
     *     min = 0,
     *     max = 5,
     *     minMessage ="La note minimum est de {{ limit }}",
     *     maxMessage="La note maximum est de {{ limit }}"
     * )
     */
    private $note;

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

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return CommentRecipe
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return CommentRecipe
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
