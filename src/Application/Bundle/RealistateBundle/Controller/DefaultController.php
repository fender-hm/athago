<?php

namespace Application\Bundle\RealistateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/realisaties", name="realistate")
     * @Template()
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('ApplicationRealistateBundle:Realistate');

        $realistates = $repository->findAll();

        return array('realistates' => $realistates);
    }
}
