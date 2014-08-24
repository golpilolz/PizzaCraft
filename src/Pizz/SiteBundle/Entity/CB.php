<?php

namespace Pizz\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CB
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizz\SiteBundle\Entity\CBRepository")
 */
class CB
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
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="integer")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="verification", type="integer")
     */
    private $verification;


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
     * @return CB
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
     * Set numero
     *
     * @param integer $numero
     * @return CB
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set date
     *
     * @param integer $date
     * @return CB
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set verification
     *
     * @param integer $verification
     * @return CB
     */
    public function setVerification($verification)
    {
        $this->verification = $verification;
    
        return $this;
    }

    /**
     * Get verification
     *
     * @return integer 
     */
    public function getVerification()
    {
        return $this->verification;
    }
}
