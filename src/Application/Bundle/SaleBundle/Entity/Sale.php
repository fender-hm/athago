<?php
namespace Application\Bundle\SaleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Sale entity
 *
 * @ORM\Entity(repositoryClass="Application\Bundle\SaleBundle\Repository\SaleRepository")
 * @ORM\Table(name="sale")
 */
class Sale
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SaleImage", mappedBy="sale", cascade={"remove"})
     */
    private $images;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullTitle;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="SaleCompany")
     * @ORM\JoinTable(name="sale_companies",
     *      joinColumns={@ORM\JoinColumn(name="sale_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="company_id", referencedColumnName="id")}
     *      )
     */
    private $companies;

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
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $links;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->companies = new ArrayCollection();
        $this->links = serialize(
            array(
                'link' => array(),
                'title' => array()
            )
        );
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
     * @param SaleImage $image
     */
    public function addImage(SaleImage $image)
    {
        $image->setSale($this);
        $this->images->add($image);
    }

    /**
     * @param SaleImage $image
     */
    public function removeImage(SaleImage $image)
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

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $fullTitle
     */
    public function setFullTitle($fullTitle)
    {
        $this->fullTitle = $fullTitle;
    }

    /**
     * @return string
     */
    public function getFullTitle()
    {
        return $this->fullTitle;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $companies
     */
    public function setCompanies($companies)
    {
        $this->companies = $companies;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param SaleCompany $company
     */
    public function addCompany(SaleCompany $company)
    {
        $company->setSale($this);
        $this->companies->add($company);
    }

    /**
     * @param SaleCompany $company
     */
    public function removeCompany(SaleCompany $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
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

    /**
     * @param string $links
     */
    public function setLinks($links)
    {
        $this->links = serialize($links);
    }

    /**
     * @return string
     */
    public function getLinks()
    {
        return unserialize($this->links);
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
}