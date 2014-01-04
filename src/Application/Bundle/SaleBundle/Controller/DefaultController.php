<?php

namespace Application\Bundle\SaleBundle\Controller;

use Application\Bundle\SaleBundle\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @return array
     *
     * @Route("/te-koop", name="sale_list")
     * @Template()
     */
    public function listAction()
    {
        $saleItems = $this->getDoctrine()->getRepository('ApplicationSaleBundle:Sale')->findAll();

        return array('items' => $saleItems);
    }

    /**
     * @param Sale $sale
     *
     * @return array
     *
     * @Route("/te-koop/{id}", name="sale_show")
     * @Template()
     */
    public function showAction(Sale $sale)
    {
        return array('item' => $sale);
    }

    /**
     * @param int $id
     *
     * @return array
     *
     * @Template()
     */
    public function getNavigationAction($id)
    {
        $prevItem = $this->getDoctrine()->getRepository('ApplicationSaleBundle:Sale')->findPrevSale($id);
        $nextItem = $this->getDoctrine()->getRepository('ApplicationSaleBundle:Sale')->findNextSale($id);

        return array('prev' => $prevItem, 'next' => $nextItem);
    }

    /**
     * @param int $count
     *
     * @return array
     *
     * @Template()
     */
    public function widgetAction($count = 4)
    {
        $items = $this->getDoctrine()->getRepository('ApplicationSaleBundle:Sale')->findLastItemsByCount($count);

        return array('items' => $items);
    }
}
