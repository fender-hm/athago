<?php
namespace Application\Bundle\RealistateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Realistate image entity
 *
 * @ORM\Entity(repositoryClass="Application\Bundle\RealistateBundle\Repository\RealistateImageRepository")
 * @ORM\Table(name="realistate_image")
 * @ORM\HasLifecycleCallbacks
 */
class RealistateImage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Realistate", inversedBy="images")
     * @ORM\JoinColumn(name="realistate_id", referencedColumnName="id")
     *
     * @var Realistate $realistate
     */
    private $realistate;

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
     * @var string $imageName
     */
    private $imageName = '';

    /**
     * @var string $tmp
     *
     * @ORM\Column(type="string", length=255, name="tmp", nullable=true)
     */
    private $tmp;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $ordering;

    public function __construct()
    {
        $this->ordering = 0;
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
        $this->getImage()->move(__DIR__.'/../../../../../../www/images/realistate/', $this->getImageName());
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemove()
    {
        unlink(__DIR__.'/../../../../../../www/images/realistate/' . $this->getImageName());
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
     * @param \Application\Bundle\RealistateBundle\Entity\Realistate $realistate
     */
    public function setRealistate($realistate)
    {
        $this->realistate = $realistate;
    }

    /**
     * @return \Application\Bundle\RealistateBundle\Entity\Realistate
     */
    public function getRealistate()
    {
        return $this->realistate;
    }

    /**
     * @param int $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return int
     */
    public function getOrdering()
    {
        return $this->ordering;
    }
}