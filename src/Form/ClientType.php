<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('datePremiereSaisie')
            ->add('adresse')
            ->add('typeVehicule' , ChoiceType::class, [
                'choices' => [
                    'Véhicule ancien' => 'véhicule ancien',
                    'SUV' => 'suv',
                    'Cabriolet' => 'cabriolet',
                    'Véhicule coupé' => 'véhicule coupé',
                    'Berline' => 'berline',
                    '4x4' => '4x4',
                    'Non gérable' => 'non gérable',
                ]
            ])
            ->add('plaqueImmat')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
