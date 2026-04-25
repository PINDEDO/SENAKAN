<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectAuthorizationFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_funcionario_only_sees_projects_they_own_or_participate_in(): void
    {
        $owner = User::factory()->create(['role' => 'funcionario']);
        $other = User::factory()->create(['role' => 'funcionario']);

        $visible = Project::create([
            'name' => 'Mi ficha',
            'code' => 'VIS-001',
            'user_id' => $owner->id,
        ]);

        $hidden = Project::create([
            'name' => 'Ajeno',
            'code' => 'HID-001',
            'user_id' => $other->id,
        ]);

        Task::create([
            'title' => 'Tarea',
            'description' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => null,
            'order' => 0,
            'project_id' => $visible->id,
            'assigned_to' => $owner->id,
            'created_by' => $owner->id,
        ]);

        $response = $this->actingAs($owner)->get(route('projects.index'));

        $response->assertOk();
        $response->assertSee('Mi ficha', false);
        $response->assertDontSee('Ajeno', false);
    }

    public function test_funcionario_cannot_delete_foreign_project(): void
    {
        $owner = User::factory()->create(['role' => 'funcionario']);
        $intruder = User::factory()->create(['role' => 'funcionario']);

        $project = Project::create([
            'name' => 'Protegido',
            'code' => 'PR-001',
            'user_id' => $owner->id,
        ]);

        $this->actingAs($intruder)
            ->delete(route('projects.destroy', $project))
            ->assertForbidden();

        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }
}
