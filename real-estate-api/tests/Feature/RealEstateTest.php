<?php

namespace Tests\Feature;

use App\Models\RealEstate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RealEstateTest extends TestCase
{
    use RefreshDatabase;

    private $validData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validData = [
            'name' => 'Test House',
            'real_state_type' => 'house',
            'street' => 'Test Street',
            'external_number' => '123',
            'internal_number' => null,
            'neighborhood' => 'Test Neighborhood',
            'city' => 'Test City',
            'country' => 'US',
            'rooms' => 3,
            'bathrooms' => 2.5,
            'comments' => 'Test property'
        ];
    }

    public function test_can_list_real_estates(): void
    {
        RealEstate::factory(5)->create();

        $response = $this->getJson('/api/real-estates');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'real_state_type', 'city', 'country']
                ]
            ]);
    }

    public function test_can_create_real_estate(): void
    {
        $data = [
            'name' => 'Test House',
            'real_state_type' => 'house',
            'street' => 'Test Street',
            'external_number' => '123',
            'internal_number' => null,
            'neighborhood' => 'Test Neighborhood',
            'city' => 'Test City',
            'country' => 'US',
            'rooms' => 3,
            'bathrooms' => 2.5,
            'comments' => 'Test property'
        ];

        $response = $this->postJson('/api/real-estates', $data);

        $response->assertCreated()
            ->assertJsonStructure([
                'id', 'name', 'real_state_type', 'street', 'external_number',
                'internal_number', 'neighborhood', 'city', 'country', 'rooms',
                'bathrooms', 'comments'
            ]);

        $this->assertDatabaseHas('real_estates', $data);
    }

    public function test_can_show_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();

        $response = $this->getJson("/api/real-estates/{$realEstate->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'real_state_type', 'street', 'external_number',
                'internal_number', 'neighborhood', 'city', 'country', 'rooms',
                'bathrooms', 'comments'
            ]);

        $this->assertDatabaseHas('real_estates', [
            'id' => $realEstate->id,
            'name' => $realEstate->name,
            'real_state_type' => $realEstate->real_state_type,
            'street' => $realEstate->street,
            'external_number' => $realEstate->external_number,
            'internal_number' => $realEstate->internal_number,
            'neighborhood' => $realEstate->neighborhood,
            'city' => $realEstate->city,
            'country' => $realEstate->country,
            'rooms' => $realEstate->rooms,
            'bathrooms' => $realEstate->bathrooms,
            'comments' => $realEstate->comments
        ]);
    }

    public function test_can_update_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();
        $updatedData = [
            'name' => 'Updated House',
            'real_state_type' => 'house',
            'street' => 'Updated Street',
            'external_number' => '456',
            'internal_number' => null,
            'neighborhood' => 'Updated Neighborhood',
            'city' => 'Updated City',
            'country' => 'US',
            'rooms' => 4,
            'bathrooms' => 3.0,
            'comments' => 'Updated property'
        ];

        $response = $this->putJson("/api/real-estates/{$realEstate->id}", $updatedData);

        $response->assertOk()
            ->assertJsonStructure([
                'id', 'name', 'real_state_type', 'street', 'external_number',
                'internal_number', 'neighborhood', 'city', 'country', 'rooms',
                'bathrooms', 'comments'
            ]);

        $this->assertDatabaseHas('real_estates', [
            'id' => $realEstate->id,
            'name' => $updatedData['name'],
            'real_state_type' => $updatedData['real_state_type'],
            'street' => $updatedData['street'],
            'external_number' => $updatedData['external_number'],
            'internal_number' => $updatedData['internal_number'],
            'neighborhood' => $updatedData['neighborhood'],
            'city' => $updatedData['city'],
            'country' => $updatedData['country'],
            'rooms' => $updatedData['rooms'],
            'bathrooms' => $updatedData['bathrooms'],
            'comments' => $updatedData['comments']
        ]);
    }

    public function test_can_delete_real_estate(): void
    {
        $realEstate = RealEstate::factory()->create();

        $response = $this->deleteJson("/api/real-estates/{$realEstate->id}");

        $response->assertNoContent();

        $this->assertSoftDeleted('real_estates', ['id' => $realEstate->id]);
    }
}
