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
    /**
     * Fonction de création du formulaire collaborateur
     *  @param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     *  @param array $options un tableau qui permet de lister les champs du formulaire.
     * 
     * @return void
     */
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
                    'placeholder' => ''
                ]
                ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'placeholder' => 'Choisir un identifiant',
                'required' => false,
                'query_builder' => function ($er) {
                    return $er->createQueryBuilder('us')
                        ->andWhere("us.admin is null")
                        ->andWhere("us.collaborateur is null")
                        ->orderBy('us.login', 'ASC');
                },
                'choice_label' => 'userlog',
                'empty_data' => null
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
