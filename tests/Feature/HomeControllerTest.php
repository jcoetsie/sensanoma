<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create(['name' => 'test', 'email' => 'test@test.com']);
    }

    /** @test */
    public function a_registered_user_should_see_index()
    {
        $response = $this->actingAs($this->user)
            ->get(route('home'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_logged_user_should_redirect_to_home()
    {
        $this->actingAs($this->user);
        $response = $this->post('/login', ['name' => 'test', 'email' => 'test@test.com']);
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function a_unregistered_user_should_redirect_to_login()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(302);
    }

    /** @test */
    public function a_unregistered_user_can_acces_forgot_passwd()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_unregistered_user_can_acces_reset_passwd()
    {
        $response = $this->get(route('password.reset', 'abc'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_unregistered_user_can_acces_to_register()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_unregistered_user_can_register()
    {
        $this->post(route('register'), [
            'name'                  => 'JhonDoe',
            'email'                 => 'Jdoe@example.com',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
            '_token'                => csrf_token()
        ]);

        $this->assertDatabaseHas('users', [
            'name'  => 'JhonDoe',
            'email' => 'Jdoe@example.com'
        ]);
    }
}
