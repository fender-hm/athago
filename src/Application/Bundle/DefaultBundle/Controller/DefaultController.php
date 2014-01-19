<?php

namespace Application\Bundle\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
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
        $page = $this->getDoctrine()->getRepository('ApplicationDefaultBundle:Page')->findOneBy(array('homepage' => true));
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

    /**
     * Contact action
     *
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/contact", name="contact-page")
     * @Template()
     */
    public function contactAction()
    {
        $page = $this->getDoctrine()->getRepository('ApplicationDefaultBundle:Page')->findOneBy(array('slug' => 'contact'));
        if (empty($page)) {
            throw new NotFoundHttpException('Page not found');
        }

        return array('page' => $page);
    }

    /**
     * Sitemap action
     *
     * @return Response
     *
     * @Route("/sitemap.xml", name="sitemap")
     *
     */
    public function sitemapAction()
    {
        $host = $this->getRequest()->getHost();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
<loc>http://' . $host . '/</loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc>http://' . $host . '/over-ons</loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc>http://' . $host . '/realisaties</loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc>http://' . $host . '/te-koop</loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc>http://' . $host . '/contact</loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
</urlset> ';
        $response = new Response($xml);
        $response->headers->add(array('Content-type' => 'text/xml'));
        return $response;
    }
}
