<?php

namespace App\Controller;

use App\Entity\image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image/add', name: 'addImage')]
    public function getExtension(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // IMG -> base64 => https://www.base64-image.de/
        // Odebranie zdjecia w base64
        $img = $request->get('source');
        $gallery_id = $request->get('gallery_id');
        $description = $request->get('description');

        // Pobranie danych niezbędnych do otrzymania rozszerzenia
        // data:image/jpeg;base64 -> jpeg
        $offset = strpos($img, '/') + 1;
        $length = strpos($img, ';') - $offset;
        $ext = substr($img, $offset, $length);

        //
        $img = str_replace('data:image/' . $ext . ';base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
        $file_name = $uuid . '.' . $ext;
        file_put_contents('../images/' . $file_name, $data);

        $image = new Image();
        $image->setSource('../images/' . $file_name);
        $image->setGalleryId($gallery_id);
        $image->setDescription($description);

        $entityManager->persist($image);
        $entityManager->flush($image);

        return new Response('Pomyślnie zapisano plik: ' . $file_name);
    }
}