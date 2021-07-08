<?php

namespace App\Form;

use App\Entity\Anounce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;
use Symfony\Component\DependencyInjection\Loader\Configurator\request;

class AnounceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label" => 'Titre',
                'attr' => [
                    'placeholder' => "Titre de l'annonce", 'class' => 'form-control'
                ]
            ])
            ->add('introduction', TextType::class, [
                'attr' => [
                    "label" => 'Introduction',
                    'placeholder' => "Titre de l'annonce", 'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    "label" => 'Description',
                    'placeholder' => "saisir une brève description", 'class' => 'form-control'
                ]
            ])
            ->add('price', NumberType::class, [
                "label" => 'Prix',
                'attr' => [
                    'placeholder' => "veuillez entrer le prix svp", 'class' => 'form-control'
                ]
            ])
            ->add('address', TextType::class, [
                "label" => 'Adresse',
                'attr' => [
                    'placeholder' => "Adresse", 'class' => 'form-control'
                ]
            ])
            ->add('coverImage', FileType::class, [
                "label" => 'ajouter une photos',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "saisir l'URL", 'class' => 'form-control'
                ]
            ])
            ->add('room', NumberType::class, [
                "label" => 'Nombre de chambre',
                'attr' => [
                    'placeholder' => "Nombre de chambre", 'class' => 'form-control'
                ]
            ])
            ->add('isAvailable')


            ->getForm();
    }
}
