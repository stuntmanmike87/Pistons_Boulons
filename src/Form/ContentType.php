<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ContentType extends AbstractType
{
    /**
     * Fonction de création du formulaire content
     *
     * Cette fonction a pour but de créer la mise en place des éléments du formulaire du contenu, ces données sont son text et sa position
     *
     * param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     * param array $options un tableau qui permet de lister les champs du formulaire.
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text')
            ->add('position', TextType::class, [
                'attr' => [
                    'placeholder' => 'texte_contact'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
