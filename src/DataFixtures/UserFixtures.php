<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures
    extends Fixture
    implements OrderedFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Client administrator account
        $user = new User();
        $user->setLogin('piston')
            ->setPassword($this->encoder->encodePassword($user, 'boulon'))
            ->setRoles(['ROLE_ADMIN']);
      


        // Default admin account
        $admin = new admin();
        $admin->setNom('Piston');
        $admin->setPrenom('Boulon')
              ->setUser($user);

        $user->setAdmin($admin);

        $manager->persist($user);
        $manager->persist($admin);

        // Flush to DB
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
