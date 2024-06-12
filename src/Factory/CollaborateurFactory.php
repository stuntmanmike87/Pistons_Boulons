<?php

namespace App\Factory;

use App\Entity\Collaborateur;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Collaborateur>
 */
final class CollaborateurFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function class(): string
    {
        return Collaborateur::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'dateEntreeEntreprise' => self::faker()->dateTime(),
            'dateNaissance' => self::faker()->dateTime(),
            'dureeTravailHebdo' => self::faker()->text(255),
            'nom' => self::faker()->text(255),
            'numSecuriteSocial' => self::faker()->text(255),
            'prenom' => self::faker()->text(255),
            'typeContrat' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Collaborateur $collaborateur): void {})
        ;
    }
}
