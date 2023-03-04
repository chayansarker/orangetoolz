<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use WithFaker;

    /**
     * test index function.
     *
     * @return void
     */
    public function test_index()
    {
        $user = User::find(3);

        $response = $this->actingAs($user)->get(route('todos.index'));

        $response->assertStatus(200);
    }

    /**
     * test store function.
     *
     * @return void
     */
    public function test_store()
    {
        $user = User::find(3);

        $response = $this->actingAs($user)
            ->post(route('todos.store'), [
                'name' => $this->faker->name,
            ]);

        $response->assertStatus(302);
    }
}
