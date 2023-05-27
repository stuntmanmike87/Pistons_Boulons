<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ClientType extends AbstractType
{
    /**
     * Fonction de création du formulaire client
     *
     * Cette fonction a pour but de créer la mise en place des éléments du formulaire du client, ces données sont son nom ; son prénom ; la date de première saisie (qui est sur le format d'une date) ;
     * son adresse ; son type de véhicule (on a une liste qui permet de faire le choix des véhicules cette liste est établi par le garage); et enfin sa plaque d'immatriculation.
     *
     * param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     * param array $options un tableau qui permet de lister les champs du formulaire.
     *
     * @return void
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('datePremiereSaisie' , DateType::class , [
                'widget' => 'single_text',
                'data' => new \DateTime("now")
            ])
            ->add('adresse')
            ->add('typeVehicule' , ChoiceType::class, [
                'choices' => [
                    'Non gérable' => 'Non gérable',
                    'Véhicule ancien' => 'Véhicule ancien',
                    'SUV' => 'SUV',
                    'Cabriolet' => 'Cabriolet',
                    'Véhicule coupé' => 'Véhicule coupé',
                    'Berline' => 'Berline',
                    '4x4' => '4x4',
                ]
            ])
            ->add('plaqueImmat', TextType::class ,   ['attr' => [
                'placeholder' => 'AZ-123-AZ ou 1234-AZ-12'
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
