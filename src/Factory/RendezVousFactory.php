<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\RendezVous;
use App\Repository\RendezVousRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<RendezVous>
 *
 * @method        RendezVous|Proxy                     create(array|callable $attributes = [])
 * @method static RendezVous|Proxy                     createOne(array $attributes = [])
 * @method static RendezVous|Proxy                     find(object|array|mixed $criteria)
 * @method static RendezVous|Proxy                     findOrCreate(array $attributes)
 * @method static RendezVous|Proxy                     first(string $sortedField = 'id')
 * @method static RendezVous|Proxy                     last(string $sortedField = 'id')
 * @method static RendezVous|Proxy                     random(array $attributes = [])
 * @method static RendezVous|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RendezVousRepository|RepositoryProxy repository()
 * @method static RendezVous[]|Proxy[]                 all()
 * @method static RendezVous[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static RendezVous[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static RendezVous[]|Proxy[]                 findBy(array $attributes)
 * @method static RendezVous[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static RendezVous[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<RendezVous> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<RendezVous> createOne(array $attributes = [])
 * @phpstan-method static Proxy<RendezVous> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<RendezVous> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<RendezVous> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<RendezVous> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<RendezVous> random(array $attributes = [])
 * @phpstan-method static Proxy<RendezVous> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<RendezVous> repository()
 * @phpstan-method static list<Proxy<RendezVous>> all()
 * @phpstan-method static list<Proxy<RendezVous>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<RendezVous>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<RendezVous>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<RendezVous>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<RendezVous>> randomSet(int $number, array $attributes = [])
 */
final class RendezVousFactory extends ModelFactory
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
    #[\Override]
    protected function getDefaults(): array
    {
        return [
            'dateRendezVous' => self::faker()->dateTime(),
            'idClient' => ClientFactory::new(),
            'idCollaborateur' => CollaborateurFactory::new(),
            'idPrestation' => PrestationFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(RendezVous $rendezVous): void {})
        ;
    }

    #[\Override]
    protected static function getClass(): string
    {
        return RendezVous::class;
    }
}
