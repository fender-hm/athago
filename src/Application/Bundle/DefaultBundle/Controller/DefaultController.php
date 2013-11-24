<?php

namespace Application\Bundle\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * Homepage action
     *
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $page = $this->getDoctrine()->getRepository('ApplicationDefaultBundle:Page')->findOneBy(array('slug' => 'welcome'));
        if (empty($page)) {
            throw new NotFoundHttpException('Page not found');
        }

        return array('page' => $page);
    }

    /**
     * Over ons action
     *
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/over-ons", name="over-ons-page")
     * @Template()
     */
    public function aboutUsAction()
    {
        $page = $this->getDoctrine()->getRepository('ApplicationDefaultBundle:Page')->findOneBy(array('slug' => 'over-ons'));
        if (empty($page)) {
            throw new NotFoundHttpException('Page not found');
        }

        return array('page' => $page);
    }
}
