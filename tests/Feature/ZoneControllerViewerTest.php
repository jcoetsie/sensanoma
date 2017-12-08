<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\SensorNode;
use App\Models\User;
use App\Models\Zone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZoneControllerViewerTest extends TestCase
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

        $this->area = factory(Area::class)->create(['account_id' => $this->userAdmin->account->id]);
        $this->zone = factory(Zone::class)->create(['area_id' => $this->area->id]);
        $this->sensorNode = factory(SensorNode::class)->create(['zone_id' => $this->zone->id, 'account_id' => $this->userAdmin->id]);
    }

    /** @test **/
    public function a_user_with_viewer_role_can_index_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('zone.index'));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_can_show_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('zone.show', $this->zone));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_create_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('zone.create'));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_store_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->post(route('zone.store', $this->zone), ['name' => 'newName', 'crop' => 'newCrop', 'coordinates' => '{}', 'area_id' => 1]);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('zones', ['name' => 'newName']);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_edit_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('zone.edit', $this->zone));

        $response->assertRedirect('/');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_update_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->put(route('zone.update', $this->zone), ['name' => 'newName', 'crop' => 'newCrop', 'coordinates' => '{}', 'area_id' => 1]);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('zones', ['name' => 'newName']);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_delete_his_zone()
    {
        $response = $this->actingAs($this->userViewer)
            ->delete(route('zone.destroy', $this->zone));

        $response->assertRedirect('/');
        $this->assertDatabaseHas('zones', ['name' => $this->zone->name]);
    }

}
