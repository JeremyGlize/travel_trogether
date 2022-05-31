<?php

namespace App\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // la méthode add accepte 3 paramètres :
        // le premier est le nom de la propriété de l'entité
        // le second est le type de champ voulu
        // le troisième est un tableau d'options à passer au formulaire.
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'title-article-form',
                    'autocomplete' => 'off'],
                'label' => 'Titre'
            ])
            ->add('content', CKEditorType::class, [
                'attr' => ['class' => 'content-article-form'],
                'label' => ' '
            ])
            ->add('user', HiddenType::class)
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ],
                'label' => 'Enregistrer'

            ]);


    }

}