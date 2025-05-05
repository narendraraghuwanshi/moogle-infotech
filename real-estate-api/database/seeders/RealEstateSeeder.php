<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Illuminate\Database\Seeder;

class RealEstateSeeder extends Seeder
{
    public function run(): void
    {
        $realEstates = [
            [
                'name' => 'Luxury House',
                'real_state_type' => 'house',
                'street' => 'Palm Street',
                'external_number' => '123',
                'internal_number' => null,
                'neighborhood' => 'Beverly Hills',
                'city' => 'Los Angeles',
                'country' => 'US',
                'rooms' => 5,
                'bathrooms' => 4.5,
                'comments' => 'Modern luxury house with pool'
            ],
            [
                'name' => 'Downtown Apartment',
                'real_state_type' => 'department',
                'street' => 'Main Street',
                'external_number' => '456',
                'internal_number' => 'A-10',
                'neighborhood' => 'Financial District',
                'city' => 'New York',
                'country' => 'US',
                'rooms' => 3,
                'bathrooms' => 2,
                'comments' => 'Spacious apartment with city view'
            ],
            // Add more seed data here
        ];

        foreach ($realEstates as $data) {
            RealEstate::create($data);
        }
    }
}
