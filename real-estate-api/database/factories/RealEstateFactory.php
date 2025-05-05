<?php

namespace Database\Factories;

use App\Models\RealEstate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{
    protected $model = RealEstate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'real_state_type' => $this->faker->randomElement(['house', 'department', 'land', 'commercial_ground']),
            'street' => $this->faker->streetName(),
            'external_number' => $this->faker->buildingNumber(),
            'internal_number' => function (array $attributes) {
                return in_array($attributes['real_state_type'], ['department', 'commercial_ground'])
                    ? $this->faker->buildingNumber()
                    : null;
            },
            'neighborhood' => $this->faker->city(),
            'city' => $this->faker->city(),
            'country' => $this->faker->countryCode(),
            'rooms' => $this->faker->numberBetween(1, 10),
            'bathrooms' => $this->faker->randomFloat(1, 1, 5),
            'comments' => $this->faker->optional()->sentence(),
        ];
    }
}
