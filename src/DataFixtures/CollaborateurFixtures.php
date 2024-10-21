<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Collaborateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class CollaborateurFixtures extends Fixture implements OrderedFixtureInterface
{
    // public function __construct(private readonly UserPasswordHasherInterface $hasher)
    // {
    // }

    // #[\Override]
    public function load(ObjectManager $manager): void
    {
        // Client administrator account
        $collaborateur = new Collaborateur();

        // $user $collaborateur->setLogin('pistons');

        // $hashedPassword = $this->hasher->hashPassword($user, 'boulons');
        // $collaborateur->setPassword($hashedPassword);
        // $user $collaborateur->setRoles(['ROLE_COLLABORATEUR']);

        $collaborateur->setDateEntreeEntreprise(date_create_from_format('Y-m-d H:i:s', '2019-09-12 09:30:00'));
        $collaborateur->setDateHeureDerniereConnexion(date_create_from_format('Y-m-d H:i:s', '2020-09-12 09:30:00'));
        $collaborateur->setDateNaissance(date_create_from_format('Y-m-d H:i:s', '2000-09-12 09:30:00'));
        $collaborateur->setDureeTravailHebdo('35h');
        $collaborateur->setIsActif(true);
        $collaborateur->setNom('employee1');
        $collaborateur->setNumSecuriteSocial('100090100100101');
        $collaborateur->setPrenom('empl1');
        $collaborateur->setTypeContrat('CDI');
        // $collaborateur->setUser($user1);

        $this->addReference('collaborateur', $collaborateur);

        $manager->persist($collaborateur);

        $manager->flush();
    }

    // #[\Override]
    public function getOrder(): int
    {
        return 2;
    }
}
