<?php

declare(strict_types=1);

namespace App\Factory;

use Override;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Client>
 *
 * @method        Client|Proxy                     create(array|callable $attributes = [])
 * @method static Client|Proxy                     createOne(array $attributes = [])
 * @method static Client|Proxy                     find(object|array|mixed $criteria)
 * @method static Client|Proxy                     findOrCreate(array $attributes)
 * @method static Client|Proxy                     first(string $sortedField = 'id')
 * @method static Client|Proxy                     last(string $sortedField = 'id')
 * @method static Client|Proxy                     random(array $attributes = [])
 * @method static Client|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ClientRepository|RepositoryProxy repository()
 * @method static Client[]|Proxy[]                 all()
 * @method static Client[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Client[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Client[]|Proxy[]                 findBy(array $attributes)
 * @method static Client[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Client[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Client> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Client> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Client> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Client> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Client> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Client> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Client> random(array $attributes = [])
 * @phpstan-method static Proxy<Client> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Client> repository()
 * @phpstan-method static list<Proxy<Client>> all()
 * @phpstan-method static list<Proxy<Client>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Client>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Client>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Client>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Client>> randomSet(int $number, array $attributes = [])
 */
final class ClientFactory extends ModelFactory
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
            'adresse' => self::faker()->text(255),
            'datePremiereSaisie' => self::faker()->dateTime(),
            'nom' => self::faker()->text(255),
            'plaqueImmat' => self::faker()->text(255),
            'prenom' => self::faker()->text(255),
            'typeVehicule' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[Override]
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Client $client): void {})
        ;
    }

    #[Override]
    protected static function getClass(): string
    {
        return Client::class;
    }
}
