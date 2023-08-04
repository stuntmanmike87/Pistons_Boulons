<?php

declare(strict_types=1);

namespace App\DataFixtures;//UserFixtures

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class AppFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // Client administrator account
        $user = new User();
        $login = $user->setLogin('pistons');
        /** @var PasswordAuthenticatedUserInterface $user */
        $pw = $this->hasher->hashPassword($user, 'boulons');
        /** @var User $user */
        $user->setPassword($pw);
        $user->setRoles(['ROLE_ADMIN']);
        
        /* $user->setLogin('pistons')
            ->setPassword($this->encoder->hashPassword($user, 'boulons'))
            ->setRoles(['ROLE_ADMIN']); */

        // Default admin account
        $admin = new admin();
        $admin->setNom('Pistons');
        $admin->setPrenom('Boulons')
              ->setUser($user);

        $user->setAdmin($admin);

        $manager->persist($user);
        $manager->persist($admin);

        // Flush to DB
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }
}
