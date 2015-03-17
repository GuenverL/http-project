<?php

namespace CV\Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CV
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CV\Bundle\Entity\CVRepository")
 */
class CV
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
    * @ORM\Column(name="author", type="string", length=255)
    * @Assert\Length(min=2)
    */
    private $author;

    /**
     * @var \DateTime
	 *	
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**
    * @ORM\OneToOne(targetEntity="CV\Bundle\Entity\Image", cascade={"persist", "remove"})
    * @Assert\Valid()
    *
    *
    *    */
    private $image;

    /**
    * @ORM\ManyToMany(targetEntity="CV\Bundle\Entity\Domaine", cascade={"persist"})
    */
    private $domaines;




	public function __construct(){
    	$this->date = new \Datetime();
	}
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
     * Set date
     *
     * @param \DateTime $date
     * @return CV
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




    public function addDomaine(Domaine $domaine)
    {
        $this->domaines[] = $domaine;
        return $this;
    }

    public function removeDomaine(Domaine $domaine)
    {
        $this->domaines->removeElement($domaine);
    }

    public function getDomaines()
    {
        return $this->domaines;
    }

    /**
    * @param Image $image
    * @return Advert
    */
    public function setImage(Image $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
   * @return Image
   */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return CV
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
}
