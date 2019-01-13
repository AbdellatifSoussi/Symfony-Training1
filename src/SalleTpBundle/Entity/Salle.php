<?php

namespace SalleTpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity(repositoryClass="SalleTpBundle\Repository\salleRepository")
 */
class Salle
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
     * @ORM\Column(name="batiment", type="string", length=255)
     * 
     * @Assert\Length (min=1, max=1, exactMessage="Votre nom dit faire {{limit}} caract�re")
     */
    private $batiment;

    /**
     * @var int
     *
     * @ORM\Column(name="etage", type="smallint")
     * 
     * @Assert\Regex (pattern="/^[0-9]$/",
     *                message="la valeur doit �tre comprise entre 0 et 9.")
     */
    private $etage;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="smallint")
     * 
     * @Assert\Regex (pattern="/^[0-9]+$/",
     *                message="la valeur doit �tre num�rique.")
     * @Assert\LessThan ( value=80, message="valeur inf�rieur ou �gale � 80")
     */
    private $numero;


    /**
     * @ORM\OneToMany(targetEntity="SalleTpBundle\Entity\Ordinateur", mappedBy="salle", cascade={"persist"})
     */
    private $ordinateurs;
    
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
     * Set batiment
     *
     * @param string $batiment
     *
     * @return Salle
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get batiment
     *
     * @return string
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set etage
     *
     * @param integer $etage
     *
     * @return Salle
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get etage
     *
     * @return int
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Salle
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }
    
    public function __toString(){
        return $this->getBatiment().'-'.$this->getEtage().'-'.$this->getNumero();
    }
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function corrigeNomBatiment(){
        $this->batiment =strtoupper($this->batiment);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ordinateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ordinateur
     *
     * @param \SalleTpBundle\Entity\Ordinateur $ordinateur
     *
     * @return Salle
     */
    public function addOrdinateur(\SalleTpBundle\Entity\Ordinateur $ordinateur)
    {
        $this->ordinateurs[] = $ordinateur;
        $ordinateur->setSalle($this);
        
        return $this;
    }

    /**
     * Remove ordinateur
     *
     * @param \SalleTpBundle\Entity\Ordinateur $ordinateur
     */
    public function removeOrdinateur(\SalleTpBundle\Entity\Ordinateur $ordinateur)
    {
        $this->ordinateurs->removeElement($ordinateur);
    }

    /**
     * Get ordinateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdinateurs()
    {
        return $this->ordinateurs;
    }
}
