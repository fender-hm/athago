<?php

namespace Application\Bundle\SliderBundle\Controller;

use Application\Bundle\SliderBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @param Slider $slider
     *
     * @return array
     *
     * @Route("/slider/{id}", name="slider")
     * @Template()
     */
    public function indexAction(Slider $slider)
    {
        return array('slider' => $slider);
    }
}
