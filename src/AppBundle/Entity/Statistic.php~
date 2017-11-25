<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatisticRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Statistic
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
     * @ORM\Column(name="ip_visitor", length=30, type="string")
     */
    private $ipVisitor;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CookingRecipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cookingRecipe;

    /**
     * @ORM\PrePersist()
     */
    public function increase()
    {
        $this->getCookingRecipe()->increaseNbVisit();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ipVisitor
     *
     * @param string $ipVisitor
     *
     * @return Statistic
     */
    public function setIpVisitor($ipVisitor)
    {
        $this->ipVisitor = $ipVisitor;

        return $this;
    }

    /**
     * Get ipVisitor
     *
     * @return string
     */
    public function getIpVisitor()
    {
        return $this->ipVisitor;
    }


    /**
     * Set cookingRecipe
     *
     * @param \AppBundle\Entity\CookingRecipe $cookingRecipe
     *
     * @return Statistic
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
