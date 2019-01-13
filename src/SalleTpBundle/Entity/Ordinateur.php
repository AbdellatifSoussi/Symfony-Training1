<?php 

namespace SalleTpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
*  @ORM\Entity(repositoryClass="SalleTpBundle\Repository\OrdinateurRepository") 
*/
class Ordinateur{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue 
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $ip;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $numero;
    
    /**
     * @ORM\ManyToOne(targetEntity="SalleTpBundle\Entity\Salle",inversedBy="ordinateurs", cascade={"persist"} )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $salle;

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
     * Set ip
     *
     * @param string $ip
     *
     * @return Ordinateur
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Ordinateur
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
     * Set salle
     *
     * @param \SalleTpBundle\Entity\Salle $salle
     *
     * @return Ordinateur
     */
    public function setSalle(\SalleTpBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return \SalleTpBundle\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }
}
