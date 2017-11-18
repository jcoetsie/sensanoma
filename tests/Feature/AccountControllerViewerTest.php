<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerViewerTest extends TestCase
{

    use RefreshDatabase;

    public $userViewer;

    public function setUp()
    {
        parent::setUp();

        // Create Admin role
        factory(Role::class)->create([
            'name' => 'viewer',
            'display_name' => 'Viewer',
            'description' => 'Viewer'
        ]);

        $this->userViewer = factory(User::class)->create();
        $this->userViewer->attachRole('viewer');
    }

    /** @test **/
    public function a_user_with_viewer_role_can_index_his_account()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('account.index'));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_viewer_role_can_show_his_account()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('account.show', $this->userViewer->account));

        $response->assertStatus(200);
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_edit_his_account()
    {
        $response = $this->actingAs($this->userViewer)
            ->get(route('account.edit', $this->userViewer->account));

        $response->assertSessionHas('warning');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_update_his_account()
    {
        $response = $this->actingAs($this->userViewer)
            ->put(route('account.update', $this->userViewer->account));

        $response->assertSessionHas('warning');
    }

    /** @test **/
    public function a_user_with_viewer_role_cannot_delete_his_account()
    {
        $response = $this->actingAs($this->userViewer)
            ->delete(route('account.destroy', $this->userViewer->account));

        $response->assertSessionHas('warning');
    }



}
