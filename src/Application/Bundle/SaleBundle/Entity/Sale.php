<?php
namespace Application\Bundle\SaleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->companies = new ArrayCollection();
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
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}