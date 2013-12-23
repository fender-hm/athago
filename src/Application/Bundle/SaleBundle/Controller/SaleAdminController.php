<?php
namespace Application\Bundle\SaleBundle\Controller;

use Application\Bundle\RealistateBundle\Entity\Realistate;
use Application\Bundle\RealistateBundle\Entity\RealistateImage;
use Application\Bundle\SaleBundle\Entity\Sale;
use Application\Bundle\SaleBundle\Entity\SaleCompany;
use Application\Bundle\SaleBundle\Entity\SaleImage;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SaleAdminController extends Controller
{
    public function uploadLogoAction()
    {
        $uploadPath = $this->container->getParameter('kernel.root_dir') . '/../web/images/sale/companies/';
        $session = $this->get('session');
        if ($session->has('companyLogo')) {
            unlink($uploadPath . $session->get('companyLogo'));
        }
        $file = $this->getUploadedFile();
        $fileName = uniqid() . '.' . $file->guessExtension();
        $file->move($uploadPath, $fileName);
        $session->set('companyLogo', $fileName);

        $response = array(
            'thumb' => $this->get('liip_imagine.cache.manager')->getBrowserPath('images/sale/companies/' . $fileName, 'sale_company_admin_thumb')
        );

        return $this->renderJson($response);
    }

    public function uploadAction()
    {
        /** @var Sale $sale */
        $sale = $this->admin->getSubject();
        $file = $this->getUploadedFile();
        $saleImage = new SaleImage();
        $saleImage->setImage($file);
        $saleImage->setImageName($file->getFilename());
        if ($sale) {
            $sale->addImage($saleImage);
        } else {
            $saleImage->setTmp($this->getRequest()->cookies->get('targetTmp'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($saleImage);
        $em->flush();

        $response = array(
            'id' => $saleImage->getId(),
            'thumb' => $this->get('liip_imagine.cache.manager')->getBrowserPath('images/sale/' . $saleImage->getImageName(), 'realistate_admin_thumb')
        );

        return $this->renderJson($response);
    }

    public function removeImageAction(SaleImage $image)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();

        return $this->renderJson(array('status' => true));
    }

    private function getUploadedFile()
    {
        if ($this->getRequest()->files->has('qqfile')) {
            return $this->getRequest()->files->get('qqfile');
        }

        return null;
    }
}