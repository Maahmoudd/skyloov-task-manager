<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'pending',
            'due_date' => '2024-11-10',
        ];

        $response = $this->post('/api/tasks', $taskData);

        $response->assertCreated();
        $this->assertDatabaseHas('tasks', $taskData);
    }


    public function test_task_creation_requires_title(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $taskData = [
            'description' => 'This is a test task.',
            'status' => 'pending',
            'due_date' => '2024-11-10 19:57:27',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }

    public function test_task_creation_requires_due_date(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'pending',

        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('due_date');
    }

    public function test_task_creation_requires_status(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => '2024-11-10 19:57:27',
            // 'status' is missing
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('status');
    }

    public function test_task_creation_requires_valid_status(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'invalid_status', // Invalid status
            'due_date' => '2024-11-10 19:57:27',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('status');
    }

    public function test_task_creation_requires_title_to_be_string(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $taskData = [
            'title' => 12345,
            'description' => 'This is a test task.',
            'status' => 'pending',
            'due_date' => '2024-11-10 19:57:27',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }

    public function test_task_creation_requires_due_date_to_be_valid_date(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'pending',
            'due_date' => 'invalid_date',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('due_date');
    }
}
