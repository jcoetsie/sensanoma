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
        $response = $this->post('/login', ['name' => 'test', 'email' => 'test@test.com']);
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function a_unregistered_user_should_redirect_to_login()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(302);
    }
}
