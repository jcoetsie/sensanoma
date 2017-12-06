<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\NodeMonitoring;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_should_store_a_notification()
    {
        $message = 'Notification Test';
        $this->user->notify((new NodeMonitoring($message)));
        $this->assertDatabaseHas('notifications', ['data' => "{\"message\":\"Notification Test\"}"]);
    }

    /** @test */
    public function it_should_store_and_set_as_read_a_notification()
    {
        $message = 'Notification Test';
        $this->user->notify((new NodeMonitoring($message)));
        $notification = $this->user->notifications()->get()->first();
        $notification->markAsRead();
        $this->assertDatabaseHas('notifications', ['read_at' => Carbon::now()]);
    }
}
