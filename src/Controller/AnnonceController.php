<?php

namespace App\Controller;

use Datetime;
use App\Entity\Anounce;
use App\Form\AnounceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AnnonceController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    #[Route('/annonce', name: 'annonce')]
    public function index(): Response
    {

        // Afficher tous les annonces
        $anounce = $this->getDoctrine()->getRepository(Anounce::class)->findAll();
        return $this->render('annonce/index.html.twig', [
            'anounce' => $anounce,
        ]);
    }
    #[Route('/show/{id}', name: 'show')]
    #[ParamConverter('anounce', class: 'App\Entity\Anounce')]
    public function show(Anounce $anounce): Response
    {

        // Afficher une annonce
        $anounce = $this->getDoctrine()->getRepository(Anounce::class)->find($anounce);
        return $this->render('annonce/show.html.twig', [
            'anounce' => $anounce,
        ]);
    }
    #[Route('/annonce/pub', name: 'annonce_pubannonce')]
    public function new(Request $request): Response
    {
        
        $form = new Anounce();
        $form = $this->createForm(AnounceType::class, $form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $form = $form->getData();
            
            $manager = $this->manager;
            $manager->persist($form);
            $manager->flush();

            return $this->redirectToRoute('annonce');
        }

        return $this->render('annonce/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

