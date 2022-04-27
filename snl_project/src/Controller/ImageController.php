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
    public function addImage(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // IMG -> base64 => https://www.base64-image.de/
        // Odebranie zdjecia w base64
        $source = $request->get('source');
        $gallery_id = $request->get('gallery_id');
        $description = $request->get('description');

        // Pobranie danych niezbędnych do otrzymania rozszerzenia
        // data:image/jpeg;base64 -> jpeg
        $offset = strpos($source, '/') + 1;
        $length = strpos($source, ';') - $offset;
        $extension = substr($source, $offset, $length);

        // Odłączenie od danych zdjęcia początku z rozszerzeniem pliku
        $source = str_replace('data:image/' . $extension . ';base64,', '', $source);
        $source = str_replace(' ', '+', $source);

        // Zamiana base64 na zdjęcie
        $img = base64_decode($source);

        // Wygenerowanie uuid dla nazwy zdjęcia
        $uuid = vsprintf('%s%s-%s', str_split(bin2hex(random_bytes(16)), 6));

        // Wygenerowanie nazwy zdjęcia i umieszczenie go w folderze na serwerze
        $file_name = $uuid . '.' . $extension;
        file_put_contents('../images/' . $file_name, $img);

        // Utworzenie obiektu do umieszczenia danych w bazie
        $image = new Image();
        $image->setSource('../images/' . $file_name);
        $image->setGalleryId($gallery_id);
        $image->setDescription($description);

        // Przygotowanie zapytań do bazy danych
        $entityManager->persist($image);
        // Wykonanie kodu sql
        $entityManager->flush($image);

        // Zwrócenie odpowiedzi
        return new Response('Pomyślnie zapisano plik: ' . $file_name);
    }
}
