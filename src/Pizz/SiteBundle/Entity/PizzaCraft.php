<?php

namespace Pizz\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PizzaCraft
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizz\SiteBundle\Entity\PizzaCraftRepository")
 */
class PizzaCraft
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredients", type="text")
     */
    private $ingredients;

    /**
     * @var float
     *
     * @ORM\Column(name="pnormal", type="float")
     */
    private $pnormal;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     * @return PizzaCraft
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    
        return $this;
    }

    /**
     * Get ingredients
     *
     * @return string 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set pnormal
     *
     * @param float $pnormal
     * @return PizzaCraft
     */
    public function setPnormal($pnormal)
    {
        $this->pnormal = $pnormal;
    
        return $this;
    }

    /**
     * Get pnormal
     *
     * @return float 
     */
    public function getPnormal()
    {
        return $this->pnormal;
    }
}
