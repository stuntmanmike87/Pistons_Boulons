<?php

declare(strict_types=1);

namespace App\Form;

use Override;
use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PrestationType extends AbstractType
{
     /**
     * Fonction de création du formulaire prestation
     * param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     * param array $options un tableau qui permet de lister les champs du formulaire.
     */
    #[Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('tempsRealisation', TextType::class, [
                'attr' => [
                    'placeholder' => '3h30'
                ]
            ])
            ->add('coutHT', TextType::class, [
                'attr' => [
                    'placeholder' => 'En euros'
                ]
            ])
            ->add('description')
            ->add('typePrestation')
        ;
    }

    #[Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
