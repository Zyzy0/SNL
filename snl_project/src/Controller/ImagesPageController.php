<?php

namespace App\Controller;

use App\Entity\image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ImagesPageController extends AbstractController
{
    #[Route('/image/page', name: 'ImagesPage')]
    public function ImagesPage(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        // Pobranie danych z POSTa
        $gallery_id =  $request->get('gallery_id');
        $page = $request->get('page');
        $length = $request->get('length');


        $offset = $page * $length - $length;


        return new JsonResponse(
            $entityManager
            ->getRepository(image::class)
            ->findBy(criteria: ['gallery_id' => $gallery_id], limit: $length, offset: $offset)
        );
    }
}
