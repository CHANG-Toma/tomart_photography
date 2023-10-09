<?php

namespace App\Controller;

use App\Repository\ImagesModeleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class portfolioController extends AbstractController
{
private $Images;

    public function __construct(ImagesModeleRepository $repoImage, ){
        $this->Images = $repoImage;
    }

    ///////////////Portfolio////////////////////
    #[Route('/', name: 'portfolio')]
    public function portfolio(): Response
    {
        $allImage = $this->Images->findAll();

        //dd($allImage);

        return $this->render('portfolio.html.twig', [
            'allImage' => $allImage
        ]);
    }


}