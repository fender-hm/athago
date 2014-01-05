<?php
namespace Application\Bundle\SliderBundle\Admin;

use Application\Bundle\SliderBundle\Entity\Slide;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class SlidesAdmin
 */
class SlidesAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slider', 'entity', array('class' => 'Application\Bundle\SliderBundle\Entity\Slider', 'empty_value' => 'Choose slider'))
            ->add('image', 'file', array('required' => false, 'data_class' => 'Symfony\Component\HttpFoundation\File\File'))
            ->add('content', 'textarea', array(
                'required' => false,
                'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')
            ));
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('image', 'string', array('template' => 'ApplicationSliderBundle:SlideAdmin:list_image.html.twig'))
            ->add('slider')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('slider');
    }

    /**
     * @param slide $slide
     *
     * @return mixed|void
     */
    public function preUpdate($slide)
    {
        $slide->setUpdated(new \DateTime());
    }
}