<?php

namespace App\Form;

use App\Entity\Anounce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                'attr'=>[
                    'placeholder'=>"Titre de l'annonce", 'class'=>'form-control'
                ]
            ])
        
            ->add('description', TextareaType::class, [
                'attr'=>[
                    'placeholder'=>"saisir une brève description", 'class'=>'form-control'
                ]
            ])
            ->add('price', NumberType::class, [
                'attr'=>[
                    'placeholder'=>"veuillez entrer le prix svp", 'class'=>'form-control'
                ]
            ])
            ->add('address', TextType::class, [
                'attr'=>[
                    'placeholder'=>"Adresse", 'class'=>'form-control'
                ]
            ])
            ->add('coverImage', TextType::class, [
                'attr'=>[
                    'placeholder'=>"saisir l'URL", 'class'=>'form-control'
                ]
            ])
            ->add('room', NumberType::class, [
                'attr'=>[
                    'placeholder'=>"Nombre de chambre", 'class'=>'form-control'
                ]
            ])
            ->add('isAvailable')
            ->add('createAt')           
            ->add('introduction', TextType::class, [
                'attr'=>[
                    'placeholder'=>"Titre de l'annonce", 'class'=>'form-control'
                ]
            ])
            ->getForm()
        ;

       

   
}
    
}
