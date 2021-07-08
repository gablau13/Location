<?php

namespace App\Controller;

use App\Entity\Anounce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAnnonceController extends AbstractController
{

    public function __construct(EntityManagerInterface $manager){
        $this->manager=$manager;

    }


    #[Route('/admin/annonce', name: 'admin_annonce')]
    public function index(): Response
    {
        $anounce = $this->getDoctrine()->getRepository(Anounce::class)->findAll();
        return $this->render('admin_annonce/index.html.twig', [
            'controller_name' => 'AdminAnnonceController', 
            'anounce' => $anounce,
        ]);
    }

    #[Route('/admin/annonces/edit/{slug}', name: 'annonces_edit')]
    public function edit(Request $request, Anounce $anounce): Response
    {

        $form = $this->createForm(AnounceType::class, $anounce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'image depuis le formulaire
            $coverImage = $form->get('coverImage')->getData();
            if ($coverImage) {
                //création d'un nom pour l'image avec l'extension récupérée
                $imageName = md5(uniqid()) . '.' . $coverImage->guessExtension();

                //on déplace l'image dans le répertoire cover_image_directory avec le nom qu'on a crée
                $coverImage->move(
                    $this->getParameter('cover_image_directory'),
                    $imageName
                );

                // on enregistre le nom de l'image dans la base de données
                $anounce->setCoverImage($imageName);
            }
            $this->manager->persist($anounce);
            $this->manager->flush();
            $this->addFlash('success', 'Annonce modifier avec succès!');
            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonce/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('admin/annonces/delete/{slug}', name: 'admin_annonce_delete')]
    public function delete(Anounce $anounce, ): Response
    {

        $this->manager->remove($anounce);
        $this->manager->flush();
        $this->addFlash('success', 'Annonce supprimer avec succès!');
        return $this->redirectToRoute('admin_annonce');

    
    }
}

