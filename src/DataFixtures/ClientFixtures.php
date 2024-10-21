<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    // #[\Override]
    public function load(ObjectManager $manager): void
    {
        // $this->loadClients($manager);

        $client1 = new Client();
        $client1
        ->setNom('Dubert')
        ->setPrenom('Alain')
        ->setDatePremiereSaisie(date_create_from_format('Y-m-d H:i:s', '2021-09-12 09:30:00'))
        ->setAdresse('3, Chemin du Bois Vert, 58470 Saint-Loup-sur-Lerre')
        ->setTypeVehicule('SUV Peugeot 3008')
        ->setPlaqueImmat('ZY-38-4YL')
        ->setIsActif(true)
        ;

        $this->addReference('client1', $client1);

        $manager->persist($client1);

        // Flush to DB
        $manager->flush();
    }

    // #[\Override]
    public function getOrder(): int
    {
        return 2;
    }

    public function loadClients(ObjectManager $manager): void
    {
        $this->generateClients(10, $manager);

        $manager->flush();
    }

    private function generateClients(int $number, ObjectManager $manager): void
    {
        for ($i = 0; $i < $number; ++$i) {
            $client = new Client();

            $client->setNom('testnom'.$i);
            $client->setPrenom('testprenom'.$i);
            $client->setDatePremiereSaisie(date_create_from_format('Y-m-d H:i:s', '2021-09-12 09:30:00'));
            $client->setAdresse('testadresse'.$i);
            $client->setTypeVehicule('testtypevehicule'.$i);
            $client->setPlaqueImmat('testplaqueimmat'.$i);
            $client->setIsActif(false); // $client->setIsActif(true);

            $manager->persist($client);
        }
    }
}
