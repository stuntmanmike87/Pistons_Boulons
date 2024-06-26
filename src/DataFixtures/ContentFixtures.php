<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ContentFixtures extends Fixture implements OrderedFixtureInterface
{
    // #[\Override]
    public function load(ObjectManager $manager): void
    {
        $tel = new Content();
        $tel
            ->setText('(+33)6-07-06-07-06')
            ->setPosition('contact_telephone');

        $adresse = new Content();
        $adresse
            ->setText('1 Quai des Mégisseries, 87200 Saint Junien, France')
            ->setPosition('contact_adresse');

        $horaires = new Content();
        $horaires
            ->setText('Lundi : 10h-17h ; Mardi : 10h-17h ; Mercredi : 10h-17h ; Jeudi : 10h-17h ; Vendredi : 10h-17h ; Samedi : 10h-17h')
            ->setPosition('contact_horaires');

        $email = new Content();
        $email
            ->setText('pistons&boulons@mail.com')
            ->setPosition('contact_email');

        $texte_affiliation = new Content();
        $texte_affiliation
            ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sodales sollicitudin ipsum. Curabitur tellus justo, volutpat in accumsan nec, euismod in ipsum. Quisque pellentesque enim condimentum, vestibulum augue sed, finibus enim. Integer varius metus ac leo euismod facilisis. Ut tempus faucibus consectetur. Curabitur non lacus nec justo vestibulum mattis. Cras lobortis malesuada lacinia.')
            ->setPosition('texte_affiliation');

        $texte_presentation = new Content();
        $texte_presentation
            ->setText('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sodales sollicitudin ipsum. Curabitur tellus justo, volutpat in accumsan nec, euismod in ipsum. Quisque pellentesque enim condimentum, vestibulum augue sed, finibus enim. Integer varius metus ac leo euismod facilisis. Ut tempus faucibus consectetur. Curabitur non lacus nec justo vestibulum mattis. Cras lobortis malesuada lacinia.')
            ->setPosition('texte_presentation');

        $manager->persist($tel);
        $manager->persist($adresse);
        $manager->persist($horaires);
        $manager->persist($email);
        $manager->persist($texte_presentation);
        $manager->persist($texte_affiliation);

        // Flush to DB
        $manager->flush();
    }

    // #[\Override]
    public function getOrder(): int
    {
        return 2;
    }
}
