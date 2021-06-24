<?php

namespace App\Controller;

use App\Entity\Anounce;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'annonce')]
    public function index(): Response
    {

        // Afficher tous les annonces
        $anounce= $this->getDoctrine()->getRepository(Anounce::class)->findAll();
        return $this->render('annonce/index.html.twig', [
            'anounce' => $anounce,
        ]);
    }
}

