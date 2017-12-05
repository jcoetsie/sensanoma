<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\SensorNode;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerAdminTest extends TestCase
{

    use RefreshDatabase;

    public $userAdmin;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create();

        // Create User with admin role
        $this->userAdmin = factory(User::class)->create();
        $this->userAdmin->attachRole('admin');

        // Create a sensor node
        $sensorNode = factory(SensorNode::class)->create(['account_id' => $this->userAdmin->account->id]);
    }

    /** @test **/
    public function it_should_return_an_user()
    {
        $this->assertInstanceOf('App\Models\User', $this->userAdmin->account->users->first());
    }

    /** @test **/
    public function it_should_return_a_sensorNodes()
    {
        $this->assertInstanceOf('App\Models\SensorNode', $this->userAdmin->account->sensorNodes->first());
    }

    /** @test **/
    public function a_user_with_admin_role_can_index_his_account()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('account.index'));

        $response->assertStatus(200);
    }


    /** @test **/
    public function a_user_with_admin_role_can_show_his_account()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('account.show', $this->userAdmin->account));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_edit_his_account()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('account.edit', $this->userAdmin->account));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_update_his_account()
    {
        $response = $this->actingAs($this->userAdmin)
            ->put(route('account.update', $this->userAdmin->account), ['name' => 'newName']);

        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_delete_his_account()
    {
        $response = $this->actingAs($this->userAdmin)
            ->delete(route('account.destroy', $this->userAdmin->account));

        $response->assertSessionHas('success');
    }

}
