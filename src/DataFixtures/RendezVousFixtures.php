<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Override;
use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;
use App\Entity\RendezVous;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

final class RendezVousFixtures extends Fixture implements OrderedFixtureInterface
{
    #[Override]
    public function load(ObjectManager $manager): void
    {
        $clientExample = new Client();
        $collabExample = new Collaborateur();
        $prestaExample = new Prestation();
        $rendezVousExample = new RendezVous();
        $rendezVousExample
        ->setIdClient($clientExample)
        ->setIdCollaborateur($collabExample)
        ->setIdPrestation($prestaExample)
        ->setDateRendezVous(date_create_from_format ( 'Y-m-d H:i:s' , '2021-09-12 09:30:00'))
        ;

        //

        $manager->persist($rendezVousExample);

        // Flush to DB
        $manager->flush();
    }

    #[Override]
    public function getOrder(): int
    {
        return 2;
    }
}
