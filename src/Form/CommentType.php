<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, [
                "label" => 'Prénom et Nom',
                'attr' => [
                    'placeholder' => "veuillez entrez votre nom complet", 'class' => 'form-control'
                ]
            ])
            ->add('mail', EmailType::class, [
                "label" => 'Email',
                'attr' => [
                    'placeholder' => "exemple@exemple.com", 'class' => 'form-control'
                ]
            ])
            ->add('content', TextareaType::class, [
                "label" => 'Commentaire',
                'attr' => [
                    'placeholder' => "votre commentaire", 'class' => 'form-control'
                ]
                
            ])
            
            ->add('rgpd', CheckboxType::class, [
                "label" => 'j\'accepte les conditions d\'utilisations'
                
                ]
            ); 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
