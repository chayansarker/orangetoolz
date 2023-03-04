<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;
    /**
     * test registration form.
     *
     * @return void
     */
    public function test_registration_form()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * test registration.
     *
     * @return void
     */
    public function test_registration()
    {
        $email = $this->faker->email;
        $password = $this->faker->password(8);

        $response = $this->post(route('register'), [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertDatabaseHas('users', ['email' => $email]);
        $this->assertAuthenticated();
    }

    /**
     * test login form.
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * test login.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post(route('login'), [
            'email' => 'developer.chayansarker+1@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticated();
    }
}
