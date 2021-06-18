<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
