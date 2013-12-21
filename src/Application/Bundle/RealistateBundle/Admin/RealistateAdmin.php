<?php
namespace Application\Bundle\RealistateBundle\Admin;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RealistateAdmin
 */
class RealistateAdmin extends Admin
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
            ->add('images', 'image_preview', array(
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
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('ApplicationRealistateBundle:Form:realistates_admin_fields.html.twig')
        );
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function prePersist($realistate)
    {
        $cookies = $this->getRequest()->cookies;

        if ($cookies->has('targetTmp')) {
            $targetTmp = $cookies->get('targetTmp');
            $em = $this->getEntityManager();
            $repository = $em->getRepository('ApplicationRealistateBundle:RealistateImage');

            $images = $repository->findBy(array('tmp' => $targetTmp));

            foreach ($images as $image) {
                $realistate->addImage($image);
                $image->setTmp(null);
            }
        }

    }

    public function preRemove($realistate)
    {
        foreach ($realistate->getImages() as $image) {
            $this->getEntityManager()->remove($image);
        }
    }
}