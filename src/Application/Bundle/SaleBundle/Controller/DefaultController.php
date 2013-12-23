<?php

namespace Application\Bundle\SaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/te-koop", name="sale_list")
     * @Template()
     */
    public function listAction()
    {
        $saleItems = $this->getDoctrine()->getRepository('ApplicationSaleBundle:Sale')->findAll();

        return array('items' => $saleItems);
    }
}
