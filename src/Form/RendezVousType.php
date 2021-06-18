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

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRendezVous')
            ->add('idClient' , EntityType::class , [
                'class' => Client::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cl')
                        ->orderBy('cl.nom', 'ASC');
                },
                'choice_label' => 'nom',
            ])
            ->add('idCollaborateur', EntityType::class , [
                'class' => Collaborateur::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('co')
                        ->orderBy('co.nom', 'ASC');
                },
                'choice_label' => 'nom',
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
