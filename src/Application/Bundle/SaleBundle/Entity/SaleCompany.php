<?php
namespace Application\Bundle\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sale company entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sale_company")
 * @ORM\HasLifecycleCallbacks
 */
class SaleCompany
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var File
     */
    private $logo;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoName;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="companies")
     * @ORM\JoinColumn(name="sale_id", referencedColumnName="id")
     *
     * @var Sale
     */
    private $sale;

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
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param \Application\Bundle\SaleBundle\Entity\Sale $sale
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
    }

    /**
     * @return \Application\Bundle\SaleBundle\Entity\Sale
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * @param string $logoName
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;
    }

    /**
     * @return string
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemove()
    {
        unlink(__DIR__.'/../../../../../../www/images/sale/companies/' . $this->getLogoName());
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
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}