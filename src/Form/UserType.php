<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserType extends AbstractType
{
     /**
     * Fonction de création du formulaire user
     *  @param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     *  @param array $options un tableau qui permet de lister les champs du formulaire.
     * 
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('roles',CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => [
                    'attr' => ['value' => "ROLE_COLLABORATEUR"] ,
                ],
            ])
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
