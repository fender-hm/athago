<?php
namespace Application\Bundle\SaleBundle\Type;

use Symfony\Component\Form\AbstractType;
/**
 * Class LinksType
 */
class LinksType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'links';
    }
} 