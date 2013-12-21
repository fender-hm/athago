<?php
namespace Application\Bundle\RealistateBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Realistate entity
 *
 * @ORM\Entity
 * @ORM\Table(name="realistate")
 */
class Realistate
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="RealistateImage", mappedBy="realistate", cascade={"remove"})
     */
    private $images;

    /**
     * @var string
     * @ORM\Column(length=255, nullable=true)
     */
    private $title;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param RealistateImage $image
     */
    public function addImage(RealistateImage $image)
    {
        $image->setRealistate($this);
        $this->images->add($image);
    }

    /**
     * @param RealistateImage $image
     */
    public function removeImage(RealistateImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}