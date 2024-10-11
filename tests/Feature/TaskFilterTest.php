<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_it_can_filter_tasks_by_status(): void
    {
        Task::factory()->create(['user_id' => $this->user->id, 'status' => 'pending']);
        Task::factory()->create(['user_id' => $this->user->id, 'status' => 'completed']);

        $response = $this->get('/api/tasks?search=status:pending');

        $response->assertStatus(200);

        $response->assertJsonFragment(['status' => 'pending']);
        $response->assertJsonMissing(['status' => 'completed']);
    }

    public function test_it_can_search_tasks_by_title(): void
    {
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'First Task']);
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'Second Task']);

        $response = $this->get('/api/tasks?search=title:First&searchFields=title:like');

        $response->assertStatus(200);

        $response->assertJsonFragment(['title' => 'First Task']);
        $response->assertJsonMissing(['title' => 'Second Task']);
    }

    public function test_it_can_filter_and_search_tasks(): void
    {
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'First Task', 'status' => 'completed']);
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'Second Task', 'status' => 'pending']);
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'Third Task', 'status' => 'pending']);

        $response = $this->get('/api/tasks?status=pending&search=Third&searchFields=title:like');

        $response->assertStatus(200);

        $response->assertJsonFragment(['title' => 'Third Task', 'status' => 'pending']);
        $response->assertJsonMissing(['title' => 'First Task']);
        $response->assertJsonMissing(['title' => 'Second Task']);
    }
}
