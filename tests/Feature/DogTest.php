<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DogTest extends TestCase
{

    public function test_store_dog() :  void {
        $payload = [
            'name' => $this->faker->firstName,
            'age' => 10
        ];

        $this->json('post', 'api/dog', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'success',
                'dog' => [
                    'name',
                    'age',
                    'born_date',
                    'updated_at',
                    'created_at',
                    'id',
                ],
                'message'
            ]);
        $this->assertDatabaseHas('dogs', $payload);

        $payload = [
            'name' => $this->faker->firstName,
            'born_date' => '2015-01-15'
        ];

        $this->json('post', 'api/dog', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'success',
                'dog' => [
                    'name',
                    'age',
                    'born_date',
                    'updated_at',
                    'created_at',
                    'id',
                ],
                'message'
            ]);
        $this->assertDatabaseHas('dogs', $payload);
    }

    /**
     * Test errros in store dogs.
     */
    public function test_errors_store_dog(): void
    {
        $payload = [
            'name' => $this->faker->firstName
        ];

        $this->json('post', 'api/dog', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'age',
                    'born_date'
                ]
            ]);

        $payload = [
            'name' => $this->faker->firstName,
            'age' => 20
        ];

        $this->json('post', 'api/dog', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'age'
                ]
            ]);
    }
}
