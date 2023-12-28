<?php

declare(strict_types=1);

namespace App\Factory;

use Override;
use App\Entity\Collaborateur;
use App\Repository\CollaborateurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Collaborateur>
 *
 * @method        Collaborateur|Proxy                     create(array|callable $attributes = [])
 * @method static Collaborateur|Proxy                     createOne(array $attributes = [])
 * @method static Collaborateur|Proxy                     find(object|array|mixed $criteria)
 * @method static Collaborateur|Proxy                     findOrCreate(array $attributes)
 * @method static Collaborateur|Proxy                     first(string $sortedField = 'id')
 * @method static Collaborateur|Proxy                     last(string $sortedField = 'id')
 * @method static Collaborateur|Proxy                     random(array $attributes = [])
 * @method static Collaborateur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CollaborateurRepository|RepositoryProxy repository()
 * @method static Collaborateur[]|Proxy[]                 all()
 * @method static Collaborateur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Collaborateur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Collaborateur[]|Proxy[]                 findBy(array $attributes)
 * @method static Collaborateur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Collaborateur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Collaborateur> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Collaborateur> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Collaborateur> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Collaborateur> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Collaborateur> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Collaborateur> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Collaborateur> random(array $attributes = [])
 * @phpstan-method static Proxy<Collaborateur> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Collaborateur> repository()
 * @phpstan-method static list<Proxy<Collaborateur>> all()
 * @phpstan-method static list<Proxy<Collaborateur>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Collaborateur>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Collaborateur>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Collaborateur>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Collaborateur>> randomSet(int $number, array $attributes = [])
 */
final class CollaborateurFactory extends ModelFactory
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

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[Override]
    protected function getDefaults(): array
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
    #[Override]
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Collaborateur $collaborateur): void {})
        ;
    }

    #[Override]
    protected static function getClass(): string
    {
        return Collaborateur::class;
    }
}
