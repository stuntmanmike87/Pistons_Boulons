<?php

declare(strict_types=1);

namespace App\Factory;

use Override;
use App\Entity\Prestation;
use App\Repository\PrestationRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Prestation>
 *
 * @method        Prestation|Proxy                     create(array|callable $attributes = [])
 * @method static Prestation|Proxy                     createOne(array $attributes = [])
 * @method static Prestation|Proxy                     find(object|array|mixed $criteria)
 * @method static Prestation|Proxy                     findOrCreate(array $attributes)
 * @method static Prestation|Proxy                     first(string $sortedField = 'id')
 * @method static Prestation|Proxy                     last(string $sortedField = 'id')
 * @method static Prestation|Proxy                     random(array $attributes = [])
 * @method static Prestation|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PrestationRepository|RepositoryProxy repository()
 * @method static Prestation[]|Proxy[]                 all()
 * @method static Prestation[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Prestation[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Prestation[]|Proxy[]                 findBy(array $attributes)
 * @method static Prestation[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Prestation[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Prestation> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Prestation> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Prestation> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Prestation> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Prestation> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Prestation> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Prestation> random(array $attributes = [])
 * @phpstan-method static Proxy<Prestation> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Prestation> repository()
 * @phpstan-method static list<Proxy<Prestation>> all()
 * @phpstan-method static list<Proxy<Prestation>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Prestation>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Prestation>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Prestation>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Prestation>> randomSet(int $number, array $attributes = [])
 */
final class PrestationFactory extends ModelFactory
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
            'coutHT' => self::faker()->randomNumber(),
            'description' => self::faker()->text(),
            'nom' => self::faker()->text(255),
            'tempsRealisation' => self::faker()->text(255),
            'typePrestation' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[Override]
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Prestation $prestation): void {})
        ;
    }

    #[Override]
    protected static function getClass(): string
    {
        return Prestation::class;
    }
}
