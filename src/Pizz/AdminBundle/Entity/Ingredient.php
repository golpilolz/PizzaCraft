<?php

namespace Pizz\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizz\AdminBundle\Entity\IngredientRepository")
 */
class Ingredient
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
     * @ORM\ManyToMany(targetEntity="Pizz\AdminBundle\Entity\TypeIngredient",
    cascade={"persist"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


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
     * Set designation
     *
     * @param string $designation
     * @return Ingredient
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    
        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Ingredient
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->type = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add type
     *
     * @param \Pizz\AdminBundle\Entity\TypeIngredient $type
     * @return Ingredient
     */
    public function setType(\Pizz\AdminBundle\Entity\TypeIngredient $type)
    {
        $this->type[] = $type;
    
        return $this;
    }

    /**
     * Remove type
     *
     * @param \Pizz\AdminBundle\Entity\TypeIngredient $type
     */
    public function removeType(\Pizz\AdminBundle\Entity\TypeIngredient $type)
    {
        $this->type->removeElement($type);
    }

    /**
     * Get type
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getType()
    {
        return $this->type;
    }
}