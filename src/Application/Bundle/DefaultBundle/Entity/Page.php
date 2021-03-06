<?php
namespace Application\Bundle\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Page entity
 *
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */
class Page
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
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $content = '';

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $metatitle;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $metadescription;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $metakeywords;

    /**
     * @param boolean $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * @return boolean
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $homepage = false;

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
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $text
     */
    public function setContent($text)
    {
        $this->content = $text;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
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
     * @param string $metadescription
     */
    public function setMetadescription($metadescription)
    {
        $this->metadescription = $metadescription;
    }

    /**
     * @return string
     */
    public function getMetadescription()
    {
        return $this->metadescription;
    }

    /**
     * @param string $metakeywords
     */
    public function setMetakeywords($metakeywords)
    {
        $this->metakeywords = $metakeywords;
    }

    /**
     * @return string
     */
    public function getMetakeywords()
    {
        return $this->metakeywords;
    }

    /**
     * @param string $metatitle
     */
    public function setMetatitle($metatitle)
    {
        $this->metatitle = $metatitle;
    }

    /**
     * @return string
     */
    public function getMetatitle()
    {
        return $this->metatitle;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}