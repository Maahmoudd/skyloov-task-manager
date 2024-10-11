<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_a_belongs_to_relationship_with_user()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->user);
        $this->assertEquals($user->id, $task->user->id);
    }

    #[Test]
    public function it_sets_user_id_when_creating_task_if_authenticated()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $task = Task::factory()->create();

        $this->assertEquals($user->id, $task->user_id);
    }

    #[Test]
    public function it_does_not_set_user_id_if_not_authenticated()
    {
        Auth::logout();

        $task = Task::factory()->create();

        $this->assertNull($task->user_id);
    }

    #[Test]
    public function it_has_a_soft_delete()
    {
        $task = Task::factory()->create();
        $task->delete();

        $this->assertSoftDeleted($task);
    }

    #[Test]
    public function it_casts_due_date_to_a_date_instance()
    {
        $task = Task::factory()->create(['due_date' => '2024-10-15']);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $task->due_date);
        $this->assertEquals('2024-10-15', $task->due_date->format('Y-m-d'));
    }


    #[Test]
    public function it_guards_id_attribute()
    {
        $task = Task::create([
            'id' => 999,
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'due_date' => '2024-10-15',
        ]);

        $this->assertNotEquals(999, $task->id);
    }

    #[Test]
    public function it_can_restore_soft_deleted_tasks()
    {
        $task = Task::factory()->create();
        $task->delete();

        $task->restore();

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
}
