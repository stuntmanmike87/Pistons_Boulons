<?php

namespace App\Form;

use App\Entity\Collaborateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CollaborateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', DateType::class , [
                'widget' => 'single_text',
                'years' => range(1960 ,date('Y')+50)
            ])
            ->add('dateEntreeEntreprise', DateType::class , [
                'widget' => 'single_text',
                'years' => range(1960 ,date('Y')+50)
            ])
            ->add('numSecuriteSocial')
            ->add('typeContrat')
            ->add('dureeTravailHebdo')
            ->add('login')
            ->add('motDePasse')
            ->add('isAdmin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
