<?php
namespace Application\Bundle\DefaultBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class PageAdmin
 */
class PageAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('title')
            ->add('slug', null, array('required' => false))
            ->add('homepage', null, array('required' => false))
            ->end()
            ->with('Content')
            ->add('content', 'textarea', array(
                'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')
            ))
            ->end()
            ->with('Metadata')
            ->add('metatitle', 'text', array('required' => false, 'label' => 'Page title'))
            ->add('metadescription', 'textarea', array('required' => false, 'label' => 'Description'))
            ->add('metakeywords', 'textarea', array('required' => false, 'label' => 'Keywords'))
            ->end();
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('homepage')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }
}