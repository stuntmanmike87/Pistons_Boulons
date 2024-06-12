<?php

namespace App\Factory;

use App\Entity\Calendar;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Calendar>
 */
final class CalendarFactory extends PersistentProxyObjectFactory
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
        return Calendar::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'all_day' => self::faker()->boolean(),
            'background_color' => self::faker()->text(7),
            'border_color' => self::faker()->text(7),
            'description' => self::faker()->text(),
            'end' => self::faker()->dateTime(),
            'start' => self::faker()->dateTime(),
            'text_color' => self::faker()->text(7),
            'title' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Calendar $calendar): void {})
        ;
    }
}
