<?php

namespace Pizz\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pizza
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizz\AdminBundle\Entity\PizzaRepository")
 */
class Pizza
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredients", type="text")
     */
    private $ingredients;

    /**
     * @var float
     *
     * @ORM\Column(name="ppetit", type="float")
     */
    private $ppetit;

    /**
     * @var float
     *
     * @ORM\Column(name="pnormale", type="float")
     */
    private $pnormale;

    /**
     * @ORM\OneToOne(targetEntity="Pizz\AdminBundle\Entity\ImagePizza", cascade={"persist"})
     */
    private $image;

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
     * Set nom
     *
     * @param string $nom
     * @return Pizza
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     * @return Pizza
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
     * Set ppetit
     *
     * @param float $ppetit
     * @return Pizza
     */
    public function setPpetit($ppetit)
    {
        $this->ppetit = $ppetit;
    
        return $this;
    }

    /**
     * Get ppetit
     *
     * @return float 
     */
    public function getPpetit()
    {
        return $this->ppetit;
    }

    /**
     * Set pnormale
     *
     * @param float $pnormale
     * @return Pizza
     */
    public function setPnormale($pnormale)
    {
        $this->pnormale = $pnormale;
    
        return $this;
    }

    /**
     * Get pnormale
     *
     * @return float 
     */
    public function getPnormale()
    {
        return $this->pnormale;
    }

    /**
     * Set image
     *
     * @param \Pizz\AdminBundle\Entity\ImagePizza $image
     * @return Pizza
     */
    public function setImage(\Pizz\AdminBundle\Entity\ImagePizza $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Pizz\AdminBundle\Entity\ImagePizza 
     */
    public function getImage()
    {
        return $this->image;
    }
}