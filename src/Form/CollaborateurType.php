<?php

namespace App\Form;

use App\Entity\Collaborateur;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CollaborateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime("now")

            ])
            ->add('dateEntreeEntreprise', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime("now")
            ])
            ->add('numSecuriteSocial')
            ->add('typeContrat')
            ->add('dureeTravailHebdo', TextType::class, [
                'attr' => [
                    'placeholder' => '35h'
                ]
                ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function ($er) {
                    return $er->createQueryBuilder('us')
                        ->orderBy('us.login', 'ASC');
                },
                'choice_label' => 'userlog',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
