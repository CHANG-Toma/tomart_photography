<?php

namespace App\Controller;

use App\Entity\ImagesModele;
use App\form\DownloadForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DownloadController extends AbstractController {

    /////////////Ajout d'image//////////////////////
    #[Route('/Form', name: 'app_form')]
    public function form(Request $request, EntityManagerInterface $em): Response
    {
        $imageDL = new ImagesModele();

        $form = $this->createForm(DownloadForm::class, $imageDL);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $texte = $form->get('texte')->getData();
            $url = $form->get('url')->getData();
            $type = $form->get('type')->getData();

            $imageDL->setTexte($texte)->setUrl($url)->setType($type);

            $em->persist($imageDL);
            $em->flush();

            $form = $this->createForm(DownloadForm::class);
        }

        return $this->render('TestBackEnd.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
