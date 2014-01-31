<?php
namespace Application\Bundle\SaleBundle\Admin;

use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class SaleAdmin
 */
class saleAdmin extends Admin
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
            ->add('fullTitle')
            ->add('shortDescription', 'textarea', array(
                'required' => false
            ))
            ->add('description', 'textarea', array(
                'required' => false,
                'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')
            ))
            ->add('images', 'sale_image_preview', array(
                'mapped' => false,
                'attr' => array('class' => 'uploader')
            ))
            ->add('companies', 'entity', array(
                'class' => 'Application\Bundle\SaleBundle\Entity\SaleCompany',
                'multiple' => true,
                'required' => false,
                'property' => 'title'
            ))
            ->add('links', 'links', array('required' => false))
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
            ->add('id')
            ->addIdentifier('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('ApplicationSaleBundle:Form:sale_admin_fields.html.twig')
        );
    }

    public function prePersist($sale)
    {
        $links = $this->getRequest()->get('links');
        $cookies = $this->getRequest()->cookies;

        if ($cookies->has('targetTmp')) {
            $targetTmp = $cookies->get('targetTmp');
            $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
            $repository = $em->getRepository('ApplicationSaleBundle:SaleImage');

            $images = $repository->findBy(array('tmp' => $targetTmp));

            foreach ($images as $image) {
                $sale->addImage($image);
                $image->setTmp(null);
            }
        }

    }

    public function preUpdate($sale)
    {
        $links = $this->getRequest()->get('links', array());

        $links['link'] = array_filter($links['link']);
        $links['title'] = array_filter($links['title']);
        $sale->setLinks($links);
    }

    public function preRemove($sale)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        foreach ($sale->getImages() as $image) {
            $em->remove($image);
        }
    }
}