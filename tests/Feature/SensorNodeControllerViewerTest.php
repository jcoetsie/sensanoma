<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\SensorNode;
use App\Models\User;
use App\Models\Zone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SensorNodeControllerViewerTest extends TestCase
{

    use RefreshDatabase;

    public $userAdmin;
    public $userViewer;
    public $area;
    public $zone;
    public $sensorNode;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create();
        // Create Viewer role
        factory(Role::class)->create([
            'name' => 'viewer',
            'display_name' => 'Viewer',
            'description' => 'Viewer'
        ]);

        $this->userAdmin = factory(User::class)->create();
        $this->userAdmin->attachRole('admin');

        $this->userViewer = factory(User::class)->create(['account_id' => $this->userAdmin->account_id]);
        $this->userViewer->attachRole('viewer');

        $this->area = factory(Area::class)->create(['account_id' => $this->userAdmin->id]);
        $this->zone = factory(Zone::class)->create(['area_id' => $this->area->id]);
        $this->sensorNode = factory(SensorNode::class)->create(['account_id' => $this->userAdmin->id, 'zone_id' => $this->zone->id]);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_index_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('sensor_node.index'));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_show_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('sensor_node.show', $this->sensorNode));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_create_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('sensor_node.create'));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_store_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->post(route('sensor_node.store', $this->area), ['name' => 'newName', 'zone_id' => 1, 'account_id' => 1, 'type' => 'newType']);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('sensor_nodes', ['name' => 'newName']);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_edit_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('sensor_node.edit', $this->sensorNode));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_update_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->put(route('sensor_node.update', $this->sensorNode), ['name' => 'newName', 'zone_id' => 1, 'account_id' => 1, 'type' => 'newType']);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('sensor_nodes', ['name' => 'newName']);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_delete_his_sensorNode()
    {
        $response = $this->actingAs($this->userViewer)
            ->delete(route('sensor_node.destroy', $this->sensorNode));

        $response->assertRedirect('/');
        $this->assertDatabaseHas('sensor_nodes', ['name' => $this->sensorNode->name]);
    }
}
