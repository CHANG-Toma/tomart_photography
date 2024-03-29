<?php

namespace App\Controller;

use App\Repository\ImagesModeleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class portfolioController extends AbstractController
{
private $Images;

    public function __construct(ImagesModeleRepository $repoImage, ){
        $this->Images = $repoImage;
    }

    ///////////////Portfolio////////////////////
    #[Route('/portfolio', name: 'portfolio')]
    public function portfolio(): Response
    {
        $allImages = $this->Images->findAll();
        $allImagesData = array_map(function($image) {
            return [
                'url' => $image->getUrl(),
                'texte' => $image->getTexte()
            ];
        }, $allImages);

        $imagesByType = [];
        foreach ($allImages as $image) {
            $type = $image->getType();
            $imagesByType[$type][] = [
                'url' => $image->getUrl(),
                'texte' => $image->getTexte()
            ];
        }

        //dd($allImages);
        //dd($imagesByType);

        return $this->render('portfolio.html.twig', [
            'allImages' => $allImagesData,
            'imagesByType' => $imagesByType
        ]);
    }

}