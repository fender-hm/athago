<?php
namespace Application\Bundle\SliderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Slider entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sliders")
 */
class Slider
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "5"
     * )
     */
    private $title = '';

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Slide", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="sliders_slides_ref",
     *      joinColumns={@ORM\JoinColumn(name="slider_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="slide_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $slides;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
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
     * @param ArrayCollection $slides
     */
    public function setSlides($slides)
    {
        $this->slides = $slides;
    }

    /**
     * @return ArrayCollection
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * @param Slide $slide
     */
    public function addSlide(Slide $slide)
    {
        $this->slides->add($slide);
    }

    /**
     * @param Slide $slide
     */
    public function removeSlide(Slide $slide)
    {
        $this->slides->removeElement($slide);
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