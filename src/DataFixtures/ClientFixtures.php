<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

final class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    public function loadg(ObjectManager $manager): void
    {
        $client1 = new Client();
        $client1
        ->setNom("Dubert")
        ->setPrenom("Alain")
        ->setDatePremiereSaisie(date_create_from_format ( 'Y-m-d H:i:s' , '2021-09-12 09:30:00'))
        ->setAdresse("3, Chemin du Bois Vert, 58470 Saint-Loup-sur-Lerre")
        ->setTypeVehicule("SUV Peugeot 3008")
        ->setPlaqueImmat("ZY-38-4YL")
        ->setIsActif(true)
        ;

        $client2 = new Client();
        $client2
        ->setNom("Client 2 : ....")
        ->setPrenom("")
        ->setDatePremiereSaisie(date_create_from_format ( 'Y-m-d H:i:s' , '2021-09-12 10:00:00'))
        ->setAdresse("")
        ->setTypeVehicule("")
        ->setPlaqueImmat("")
        ->setIsActif(false)
        ;

        $client3 = new Client();
        $client3->setNom("Client 3 : ....")
        ->setPrenom("")
        ->setDatePremiereSaisie(date_create_from_format ( 'Y-m-d H:i:s' , '2021-10-05 16:00:00'))
        ->setAdresse("")
        ->setTypeVehicule("")
        ->setPlaqueImmat("")
        ->setIsActif(false)
        ;

        $manager->persist($client1);
        $manager->persist($client2);
        $manager->persist($client3);

        // Flush to DB
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }

    /**
     * Fonction de chargement des fixtures en base de données
     */
    public function load(ObjectManager $manager): void
    {
        $this->generateClients(10, $manager);

        $manager->flush();
    }

    /**
     * generateClients function
     */
    private function generateClients(int $number, ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < $number; ++$i) {
            $client = new Client();

            $client->setNom('testnom'.$i);
            $client->setPrenom('testprenom'.$i);
            $client->setDatePremiereSaisie($faker->date_create_from_format('Y-m-d H:i:s' , '2021-09-12 09:30:00'));
            $client->setAdresse('testadresse'.$i);
            $client->setTypeVehicule('testtypevehicule'.$i);
            $client->setPlaqueImmat('testplaqueimmat'.$i);
            $client->setIsActif(false);//$client->setIsActif(true);

            $manager->persist($client);
        }
    }
}
