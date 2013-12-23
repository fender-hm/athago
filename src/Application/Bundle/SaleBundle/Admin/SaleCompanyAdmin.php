<?php
namespace Application\Bundle\SaleBundle\Admin;

use Application\Bundle\SaleBundle\Entity\SaleCompany;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class SaleCompanyAdmin
 */
class SaleCompanyAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('description', 'textarea', array(
                'required' => false,
                'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')
            ))
            ->add('logo', 'logo_preview', array(
                'mapped' => false,
                'attr' => array('class' => 'uploader')
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

    /**
     * @param SaleCompany $saleCompany
     *
     * @return mixed|void
     */
    public function prePersist($saleCompany)
    {
        $session = $this->getConfigurationPool()->getContainer()->get('session');

        if ($session->has('companyLogo')) {
            $saleCompany->setLogoName($session->get('companyLogo'));
            $session->remove('companyLogo');
        }
    }

    /**
     * @param SaleCompany $saleCompany
     *
     * @return mixed|void
     */
    public function preUpdate($saleCompany)
    {
        $this->prePersist($saleCompany);
    }
}