<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_funcionario_cannot_reorder_task_they_do_not_own_or_assign(): void
    {
        $owner = User::factory()->create(['role' => 'funcionario']);
        $other = User::factory()->create(['role' => 'funcionario']);

        $project = Project::create([
            'name' => 'Proyecto A',
            'code' => 'FICHA-01',
            'user_id' => $owner->id,
        ]);

        $task = Task::create([
            'title' => 'Tarea privada',
            'description' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => null,
            'order' => 0,
            'project_id' => $project->id,
            'assigned_to' => $owner->id,
            'created_by' => $owner->id,
        ]);

        $response = $this->actingAs($other)->postJson(route('tasks.updateOrder'), [
            'task_id' => $task->id,
            'status' => 'progress',
            'order' => 0,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'pending',
        ]);
    }

    public function test_funcionario_cannot_create_task_in_foreign_project_without_involvement(): void
    {
        $owner = User::factory()->create(['role' => 'funcionario']);
        $intruder = User::factory()->create(['role' => 'funcionario']);

        $project = Project::create([
            'name' => 'Proyecto cerrado',
            'code' => 'FICHA-02',
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($intruder)->post(route('tasks.store'), [
            '_token' => csrf_token(),
            'title' => 'Intruso',
            'project_id' => $project->id,
            'priority' => 'low',
        ]);

        $response->assertForbidden();
    }

    public function test_funcionario_can_create_task_on_own_project(): void
    {
        $owner = User::factory()->create(['role' => 'funcionario']);

        $project = Project::create([
            'name' => 'Mi proyecto',
            'code' => 'FICHA-03',
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($owner)->post(route('tasks.store'), [
            'title' => 'Primera tarea',
            'project_id' => $project->id,
            'priority' => 'medium',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', [
            'title' => 'Primera tarea',
            'project_id' => $project->id,
            'created_by' => $owner->id,
        ]);
    }
}
