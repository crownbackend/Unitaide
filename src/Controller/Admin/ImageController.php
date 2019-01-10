<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAdminController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class ImageController extends AbstractController
{
    /**
     * @Route("/supprimer/images/{id}", name="admin_delete_image")
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        // get id for image
        $image = $this->getDoctrine()->getRepository(Image::class)->find($id);
        // remove and flush bdd
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();
        return $this->redirectToRoute('admin_list_article');
    }
}



