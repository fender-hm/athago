<?php
namespace Application\Bundle\DefaultBundle\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Class ImagePreviewType
 */
class ImagePreviewType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'file';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'image_preview';
    }
} 