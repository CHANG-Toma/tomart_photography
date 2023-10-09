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
        $ImagesTravel = $this->Images->findBy("Travel");
        $ImagesPortrait = $this->Images->findBy("Portrait");
        $ImagesSport = $this->Images->findBy("Sport");
        $allImage = $this->Images->findAll();
        //dd($allImage);

        return $this->render('portfolio.html.twig', [
            'allImage' => $allImage,
            'ImagesTravel' => $ImagesTravel,
            'ImagesPortrait' => $ImagesPortrait,
            'ImagesSport' => $ImagesSport
        ]);
    }
}