<?php

namespace App\Controller;

use Datetime;
use App\Entity\Anounce;
use App\Entity\Comment;
use App\Form\AnounceType;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class AnnonceController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    #[Route('/annonces', name: 'annonces_index')]
    public function index(): Response
    {

        // Afficher tous les annonces
        $anounce = $this->getDoctrine()->getRepository(Anounce::class)->findAll();
        return $this->render('annonce/index.html.twig', [
            'anounce' => $anounce,
        ]);
    }
    #[Route('/annonces/create', name: 'annonces_create')]
    public function create(Request $request): Response
    {
        $anounce = new Anounce();
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

            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonce/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/annonces/{slug}', name: 'annonces_show')]
    #[ParamConverter('anounce', class: 'App\Entity\Anounce')]
    public function show(Anounce $anounce, Request $request, EntityManagerInterface $manager): Response
    {
        $anounce = $this->getDoctrine()->getRepository(Anounce::class)->find($anounce);
        
        $comment = new Comment;
        // On génére le formulaire
        $commentForm = $this->CreateForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        //Traitement du formulaire
        if($commentForm->isSubmitted() && $commentForm->isValid())
        {
            
            
            $comment->setCreatedAt(new Datetime());
            $comment->setAnounce($anounce);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('annonces_show', ['slug'=>$anounce->getSlug()]);
        }

        return $this->render('annonce/show.html.twig', [
            'anounce' => $anounce,
            
            'commentForm' => $commentForm->createView()
        ]);
    }
    #[Route('/annonces/edit/{slug}', name: 'annonces_edit')]
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
    #[Route('/annonces/delete/{slug}', name: 'annonces_delete')]
    public function delete(Anounce $anounce): Response
    {

        $this->manager->remove($anounce);
        $this->manager->flush();
        $this->addFlash('success', 'Annonce supprimer avec succès!');
        return $this->redirectToRoute('annonces_index');
    }
}
