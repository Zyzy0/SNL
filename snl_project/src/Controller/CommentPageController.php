<?php

namespace App\Controller;

use App\Entity\comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentPageController extends AbstractController
{
    #[Route('/comment/page', name: 'CommentPage')]
    public function CommentPage(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        // Pobranie danych z POSTa
        $image_id =  $request->get('image_id');
        $page = $request->get('page');
        $length = $request->get('length');


        $offset = $page * $length - $length;


        return new JsonResponse(
            $entityManager
            ->getRepository(comment::class)
            ->findBy(criteria: ['image_id' => $image_id], limit: $length, offset: $offset)
        );
    }
}
