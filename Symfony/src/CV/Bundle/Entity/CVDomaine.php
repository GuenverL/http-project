<?php
// src/OC/PlatformBundle/Entity/CVDomaine.php

namespace CV\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CV\Bundle\Entity\CVDomaineRepository")
 */
class CVDomaine
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\ManyToOne(targetEntity="CV\Bundle\Entity\CV")
   * @ORM\JoinColumn(nullable=false)
   */
  private $cv;

  /**
   * @ORM\ManyToOne(targetEntity="CV\Bundle\Entity\Domaine")
   * @ORM\JoinColumn(nullable=false)
   */
  private $domaine;


  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param CV $cv
   * @return CVDomaine
   */
  public function setCV(CV $cv)
  {
    $this->cv = $cv;
    return $this;
  }

  /**
   * @return CV
   */
  public function getCV()
  {
    return $this->cv;
  }

  /**
   * @param Domaine $domaine
   * @return CVDomaine
   */
  public function setDomaine(Domaine $domaine)
  {
    $this->domaine = $domaine;
    return $this;
  }

  /**
   * @return Domaine
   */
  public function getDomaine()
  {
    return $this->domaine;
  }


    /**
     * Set advert
     *
     * @param \CV\PlatformBundle\Entity\CV $advert
     * @return CVDomaine
     */
    public function setAdvert(\CV\PlatformBundle\Entity\CV $advert)
    {
        $this->advert = $advert;
    
        return $this;
    }

    /**
     * Get advert
     *
     * @return \CV\PlatformBundle\Entity\CV 
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
