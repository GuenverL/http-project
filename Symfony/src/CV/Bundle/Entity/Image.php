<?php

namespace CV\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="CV\Bundle\Entity\ImageRepository")
 */
class Image
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="url", type="string", length=255)
   * @Assert\Length(max=255)
   * @Assert\Url()
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt;

  /**
   * @Assert\File()
   */
  private $file;

  private $tempFilename;

  public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file = null)
  {
    $this->file = $file;
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    if (null === $this->file) {
      return;
    }
    $name = $this->file->getClientOriginalName();
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }
    $this->file->move($this->getUploadRootDir(), $name);
    $this->url = $name;
    $this->alt = $name;
  }

    /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }
        $this->url = $this->file->guessExtension();

        $this->alt = $this->file->getClientOriginalName();;
    }

    public function getUploadDir(){
        return 'uploads/img';
    }

    protected function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    if (file_exists($this->tempFilename)) {
      unlink($this->tempFilename);
    }
  }

  public function getId(){
    return $this->id;
  }

  public function getUrl(){
    return $this->url;
  }

  public function getAlt(){
    return $this->alt;
  }

  public function getWebPath(){
    return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
  }
}