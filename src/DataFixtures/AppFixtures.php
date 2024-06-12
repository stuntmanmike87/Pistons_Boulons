<?php

declare(strict_types=1);

namespace App\DataFixtures; // UserFixtures

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class AppFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        // Client administrator account
        $user = new User();

        $user->setLogin('pistons');

        $hashedPassword = $this->hasher->hashPassword($user, 'boulons');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);

        /* $user->setLogin('pistons')
            ->setPassword($this->encoder->hashPassword($user, 'boulons'))
            ->setRoles(['ROLE_ADMIN']); */

        // Flush to DB
        $manager->flush();
    }

    #[\Override]
    public function getOrder(): int
    {
        return 2;
    }
}
