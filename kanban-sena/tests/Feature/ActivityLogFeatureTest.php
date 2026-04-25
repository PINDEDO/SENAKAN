<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLogFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_activity_audit_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $project = Project::create([
            'name' => 'Proyecto',
            'code' => 'F-001',
            'user_id' => $admin->id,
        ]);

        $task = Task::create([
            'title' => 'Tarea',
            'description' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => null,
            'order' => 0,
            'project_id' => $project->id,
            'assigned_to' => $admin->id,
            'created_by' => $admin->id,
        ]);

        ActivityLog::create([
            'user_id' => $admin->id,
            'task_id' => $task->id,
            'action' => 'created',
            'description' => 'Creó la tarea: Tarea',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.activity'));

        $response->assertOk();
        $response->assertSee('Auditoría de actividad', false);
        $response->assertSee('Creó la tarea: Tarea', false);
    }

    public function test_funcionario_cannot_access_activity_audit(): void
    {
        $user = User::factory()->create(['role' => 'funcionario']);

        $this->actingAs($user)
            ->get(route('admin.activity'))
            ->assertForbidden();
    }

    public function test_admin_can_filter_activity_by_action(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        ActivityLog::create([
            'user_id' => $admin->id,
            'task_id' => null,
            'action' => 'updated',
            'description' => 'Solo actualización',
        ]);

        ActivityLog::create([
            'user_id' => $admin->id,
            'task_id' => null,
            'action' => 'created',
            'description' => 'Solo creación',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.activity', ['action' => 'updated']));

        $response->assertOk();
        $response->assertSee('Solo actualización', false);
        $response->assertDontSee('Solo creación', false);
    }
}
