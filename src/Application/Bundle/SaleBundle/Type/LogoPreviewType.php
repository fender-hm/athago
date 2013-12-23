<?php
namespace Application\Bundle\SaleBundle\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Class LogoPreviewType
 */
class LogoPreviewType extends AbstractType
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
        return 'logo_preview';
    }
} 