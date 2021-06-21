<?php

namespace App\Form;

use App\Entity\RendezVous;
use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RendezVousType extends AbstractType
{   
    /**
     * Fonction de création du formulaire rendez-vous
     * 
     * Cette fonction a pour but de créer la mise en place des éléments du formulaire du rendez-vous, ces données sont sa date de rendez-vous; son client ; son collaborateur et sa prestation.
     * 
     *  @param FormBuilderInterace $builder une variable qui permet la création d'un formulaire
     *  @param array $options un tableau qui permet de lister les champs du formulaire.
     * 
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRendezVous', DateTimeType::class , [
                'widget' => 'single_text',
                'view_timezone' => 'Europe/Paris'
            ])
            ->add('idClient' , EntityType::class , [
                'class' => Client::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cl')
                        ->orderBy('cl.nom', 'ASC');
                },
                'choice_label' => 'client',
            ])
            ->add('idCollaborateur', EntityType::class , [
                'class' => Collaborateur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('co')
                        ->orderBy('co.nom', 'ASC');
                },
                'choice_label' => 'collaborateur',
            ])
            ->add('idPrestation', EntityType::class , [
                'class' => Prestation::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
