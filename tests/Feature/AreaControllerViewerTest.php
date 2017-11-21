<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaControllerViewerTest extends TestCase
{

    use RefreshDatabase;

    public $userViewer;
    public $area;

    public function setUp()
    {
        parent::setUp();

        factory(Role::class)->create([
            'name' => 'viewer',
            'display_name' => 'Viewer',
            'description' => 'Viewer'
        ]);

        $this->userViewer = factory(User::class)->create();
        $this->userViewer->attachRole('viewer');

        $this->area = factory(Area::class)->create(['account_id' => $this->userViewer->account->id]);
    }

    /** @test **/
    public function a_user_with_viewer_role_can_index_his_area()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('area.index'));

        $response->assertStatus(200);
    }


    /** @test **/
    public function a_user_with_viewer_role_can_show_his_area()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('area.show', $this->area));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_edit_his_area()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('area.edit', $this->area));

        $response->assertStatus(302);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_update_his_area()
    {
        $response = $this->actingAs($this->userViewer)
            ->put(route('area.update', $this->area), ['name' => 'newName', 'address' => 'newAddress', 'coordinates' => '{}']);

        $response->assertSessionHas('warning');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_delete_his_area()
    {
        $response = $this->actingAs($this->userViewer)
            ->delete(route('area.destroy', $this->area));

        $response->assertSessionHas('warning');
    }

}
