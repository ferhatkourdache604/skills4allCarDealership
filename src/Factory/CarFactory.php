<?php

namespace App\Factory;

use App\Entity\Car;
use App\Repository\CarRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Car>
 *
 * @method        Car|Proxy create(array|callable $attributes = [])
 * @method static Car|Proxy createOne(array $attributes = [])
 * @method static Car|Proxy find(object|array|mixed $criteria)
 * @method static Car|Proxy findOrCreate(array $attributes)
 * @method static Car|Proxy first(string $sortedField = 'id')
 * @method static Car|Proxy last(string $sortedField = 'id')
 * @method static Car|Proxy random(array $attributes = [])
 * @method static Car|Proxy randomOrCreate(array $attributes = [])
 * @method static CarRepository|RepositoryProxy repository()
 * @method static Car[]|Proxy[] all()
 * @method static Car[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Car[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Car[]|Proxy[] findBy(array $attributes)
 * @method static Car[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Car[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CarFactory extends ModelFactory
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
    protected function getDefaults(): array
    {
        return [
            'cost' => self::faker()->numberBetween(10000,200000),
            'name' => self::faker()->words(3, true),
            'updated_at' => self::faker()->dateTime(),
            'nbSeats' => self::faker()->numberBetween(2,7),
            'nbDoors' => self::faker()->numberBetween(1,5),
            'description' => self::faker()->paragraph(),
            'color' => self::faker()->randomElement(['black','white','blue','green','pink','yellow','purple']),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Car $car): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Car::class;
    }
}
