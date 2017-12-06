<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\SensorNode;
use App\Models\User;
use App\Models\Zone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SensorNodeControllerAdminTest extends TestCase
{

    use RefreshDatabase;

    public $userAdmin;
    public $area;
    public $zone;
    public $sensorNode;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create();

        $this->userAdmin = factory(User::class)->create();
        $this->userAdmin->attachRole('admin');

        $this->area = factory(Area::class)->create(['account_id' => $this->userAdmin->id]);
        $this->zone = factory(Zone::class)->create(['area_id' => $this->area->id]);
        $this->sensorNode = factory(SensorNode::class)->create(['account_id' => $this->userAdmin->id, 'zone_id' => $this->zone->id]);
    }

    /** @test **/
    public function it_should_return_a_array_of_config()
    {
        $this->assertArrayHasKey('name', $this->sensorNode->type);
    }

    /** @test **/
    public function it_should_return_an_account()
    {
        $this->assertInstanceOf('App\Models\Account', $this->sensorNode->account);
    }

    /** @test **/
    public function it_should_return_a_zone()
    {
        $this->assertInstanceOf('App\Models\Zone', $this->sensorNode->zone);
    }

    /** @test **/
    public function a_user_with_admin_role_can_index_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('sensor_node.index'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_show_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('sensor_node.show', $this->sensorNode));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_create_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('sensor_node.create'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_store_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->post(route('sensor_node.store', $this->area), ['name' => 'newName', 'zone_id' => 1, 'account_id' => 1, 'type' => 'newType']);

        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_edit_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('sensor_node.edit', $this->sensorNode));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_update_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->put(route('sensor_node.update', $this->sensorNode), ['name' => 'newName', 'zone_id' => 1, 'account_id' => 1, 'type' => 'newType']);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('sensor_nodes', ['name' => 'newName']);
    }

    /** @test **/
    public function a_user_with_admin_role_can_delete_his_sensorNode()
    {
        $response = $this->actingAs($this->userAdmin)
            ->delete(route('sensor_node.destroy', $this->sensorNode));

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('sensor_nodes', ['name' => $this->sensorNode->name]);
    }

}
