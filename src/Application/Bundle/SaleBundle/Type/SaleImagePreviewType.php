<?php
namespace Application\Bundle\SaleBundle\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Class SaleImagePreviewType
 */
class SaleImagePreviewType extends AbstractType
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
        return 'sale_image_preview';
    }
} 