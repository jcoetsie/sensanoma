<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaControllerAdminTest extends TestCase
{

    use RefreshDatabase;

    public $userAdmin;
    public $userAdmin2;
    public $area;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create();

        $this->userAdmin = factory(User::class)->create();
        $this->userAdmin->attachRole('admin');

        $this->userAdmin2 = factory(User::class)->create();
        $this->userAdmin2->attachRole('admin');

        $this->area = factory(Area::class)->create(['account_id' => $this->userAdmin->account->id]);
    }

    /** @test **/
    public function it_should_return_a_collection_of_areas()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->area->zones()->get());
    }

    /** @test **/
    public function a_user_with_admin_role_can_index_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('area.index'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_show_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('area.show', $this->area));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_create_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('area.create'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_store_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->post(route('area.store', $this->area), ['name' => 'newName', 'address' => 'newAddress', 'coordinates' => '{}']);

        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_edit_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->get(route('area.edit', $this->area));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_admin_role_can_update_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->put(route('area.update', $this->area), ['name' => 'newName', 'address' => 'newAddress', 'coordinates' => '{}']);

        $response->assertSessionHas('success');
    }

    /** @test **/
    public function a_user_with_admin_role_can_delete_his_area()
    {
        $response = $this->actingAs($this->userAdmin)
            ->delete(route('area.destroy', $this->area));

        $response->assertRedirect(route('area.index'));
        $response->assertSessionHas('success');
    }

}
