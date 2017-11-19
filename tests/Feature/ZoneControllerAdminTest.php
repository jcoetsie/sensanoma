<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\SensorNode;
use App\Models\User;
use App\Models\Zone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZoneControllerAdminTest extends TestCase
{

    use RefreshDatabase;

    public $userAdmin;
    public $userAdmin2;
    public $zone;
    public $sensorNode;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create();

        $this->userAdmin = factory(User::class)->create();
        $this->userAdmin->attachRole('admin');

        $this->area = factory(Area::class)->create(['account_id' => $this->userAdmin->account->id]);
        $this->zone = factory(Zone::class)->create(['area_id' => $this->area->id]);
        $this->sensorNode = factory(SensorNode::class)->create(['zone_id' => $this->zone->id]);
    }

    /** @test **/
    public function it_should_return_a_collection_of_zones()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->zone->sensorNodes()->get());
    }

    /** @test **/
    public function a_user_with_admin_role_can_index_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('zone.index', $this->zone));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_show_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('zone.show', $this->zone));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_create_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('zone.create'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_store_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->post(route('zone.store', $this->zone), ['name' => 'newName', 'crop' => 'newCrop', 'coordinates' => '{}', 'area_id' => 1]);

        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_edit_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('zone.edit', $this->zone));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_update_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->put(route('zone.update', $this->zone), ['name' => 'newName', 'crop' => 'newCrop', 'coordinates' => '{}', 'area_id' => 1]);
        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_delete_his_zone()
    {
        $response = $this->actingAs($this->userAdmin)
            ->delete(route('zone.destroy', $this->zone));

        $response->assertSessionHas('success');
    }

}
