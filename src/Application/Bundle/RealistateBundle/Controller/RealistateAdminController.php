<?php
namespace Application\Bundle\RealistateBundle\Controller;

use Application\Bundle\RealistateBundle\Entity\Realistate;
use Application\Bundle\RealistateBundle\Entity\RealistateImage;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RealistateAdminController extends Controller
{
    public function uploadAction()
    {
        /** @var Realistate $realistate */
        $realistate = $this->admin->getSubject();
        $file = $this->getUploadedFile();
        $realistateImage = new RealistateImage();
        $realistateImage->setImage($file);
        $realistateImage->setImageName($file->getFilename());
        if ($realistate) {
            $realistate->addImage($realistateImage);
        } else {
            $realistateImage->setTmp($this->getRequest()->cookies->get('targetTmp'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($realistateImage);
        $em->flush();

        $response = array(
            'id' => $realistateImage->getId(),
            'thumb' => $this->get('liip_imagine.cache.manager')->getBrowserPath('images/realistate/' . $realistateImage->getImageName(), 'realistate_admin_thumb')
        );

        return $this->renderJson($response);
    }

    public function removeImageAction(RealistateImage $image)
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
        if ($this->getRequest()->query->has('qqfile')) {
            $input = fopen("php://input", "r");
            $fileStream = tmpfile();
            stream_copy_to_stream($input, $fileStream);
            fclose($input);
            $fileTmp = tempnam('/tmp', 'tfq');
            $target = fopen($fileTmp, "w");
            fseek($fileStream, 0, SEEK_SET);
            stream_copy_to_stream($fileStream, $target);
            fclose($target);

            return new UploadedFile($fileTmp);
        }

        return null;
    }
}