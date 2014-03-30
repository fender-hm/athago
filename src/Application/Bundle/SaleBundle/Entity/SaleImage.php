<?php
namespace Application\Bundle\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sale image entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sale_image")
 * @ORM\HasLifecycleCallbacks
 */
class SaleImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="images")
     * @ORM\JoinColumn(name="sale_id", referencedColumnName="id")
     *
     * @var Sale
     */
    private $sale;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     *
     * @var File $image
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     *
     * @var string
     */
    private $imageName = '';

    /**
     * @var string $tmp
     *
     * @ORM\Column(type="string", length=255, name="tmp", nullable=true)
     */
    private $tmp;

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
     * @param \Symfony\Component\HttpFoundation\File\File $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @ORM\PrePersist()
     */
    public function preEvents()
    {
        if ($this->getImage()) {
            $this->setImageName(uniqid() . '.' . $this->getImage()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     */
    public function postEvents()
    {
        $this->getImage()->move(__DIR__.'/../../../../../../www/images/sale/', $this->getImageName());
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemove()
    {
        unlink(__DIR__.'/../../../../../../www/images/sale/' . $this->getImageName());
    }

    /**
     * @param string $tmp
     */
    public function setTmp($tmp)
    {
        $this->tmp = $tmp;
    }

    /**
     * @return string
     */
    public function getTmp()
    {
        return $this->tmp;
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
}