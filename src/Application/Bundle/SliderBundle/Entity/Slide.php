<?php
namespace Application\Bundle\SliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Slider slide entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sliders_slides")
 * @Vich\Uploadable
 */
class Slide
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="slide_image", fileNameProperty="imageName")
     *
     * @var File $image
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     *
     * @var string $imageName
     */
    private $imageName = '';

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $content = '';

    /**
     * @var Slider
     *
     * @ORM\ManyToOne(targetEntity="Slider", inversedBy="slides")
     * @ORM\JoinColumn(name="slider_id", referencedColumnName="id")
     */
    private $slider;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->updated = new \DateTime();
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * @param File $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param \Application\Bundle\SliderBundle\Entity\Slider $slider
     */
    public function setSlider($slider)
    {
        $this->slider = $slider;
    }

    /**
     * @return \Application\Bundle\SliderBundle\Entity\Slider
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getImageName();
    }
}