<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Collaborateur;
use App\Entity\Prestation;
use App\DataFixtures\ClientFixtures;
use App\DataFixtures\CollaborateurFixtures;
use App\DataFixtures\PrestationsFixtures;
use App\Entity\RendezVous;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class RendezVousFixtures extends Fixture implements OrderedFixtureInterface
{
    // #[\Override]
    public function load(ObjectManager $manager): void
    {
        $rendezVousExample = new RendezVous();

        /** @var Client|null $clientExample */
        $clientExample = $this->getReference('client1');
        // get a reference to a ClientFixture
        $rendezVousExample->setIdClient($clientExample);

        /** @var Collaborateur|null $collabExample */
        $collabExample = $this->getReference('collaborateur');
        // get a reference to a CollaborateurFixture
        $rendezVousExample->setIdCollaborateur($collabExample);

        /** @var Prestation|null $prestaExample */
        $prestaExample = $this->getReference('presta1');
        // get a reference to a PrestationFixture
        $rendezVousExample->setIdPrestation($prestaExample);

        $rendezVousExample
            // ->setIdClient($clientExample)
            // ->setIdCollaborateur($collabExample)
            // ->setIdPrestation($prestaExample)
            ->setDateRendezVous(date_create_from_format('Y-m-d H:i:s', '2021-09-12 09:30:00'))
        ;

        $manager->persist($rendezVousExample);

        // Flush to DB
        $manager->flush();
    }

    // #[\Override]
    public function getOrder(): int
    {
        return 2;
    }

    /** @return array<mixed> */
    public function getDependencies(): array
    {
        return [
            ClientFixtures::class,
            CollaborateurFixtures::class,
            PrestationsFixtures::class,
        ];
    }
}
