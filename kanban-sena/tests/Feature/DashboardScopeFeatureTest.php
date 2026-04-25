<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardScopeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_funcionario_dashboard_metrics_exclude_other_users_tasks(): void
    {
        $a = User::factory()->create(['role' => 'funcionario']);
        $b = User::factory()->create(['role' => 'funcionario']);

        $projectA = Project::create(['name' => 'PA', 'code' => 'A-001', 'user_id' => $a->id]);
        $projectB = Project::create(['name' => 'PB', 'code' => 'B-001', 'user_id' => $b->id]);

        Task::create([
            'title' => 'Solo A',
            'description' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => null,
            'order' => 0,
            'project_id' => $projectA->id,
            'assigned_to' => $a->id,
            'created_by' => $a->id,
        ]);

        Task::create([
            'title' => 'Solo B',
            'description' => null,
            'status' => 'done',
            'priority' => 'low',
            'due_date' => null,
            'order' => 0,
            'project_id' => $projectB->id,
            'assigned_to' => $b->id,
            'created_by' => $b->id,
        ]);

        $html = $this->actingAs($a)->get(route('dashboard'))->assertOk()->getContent();

        $this->assertStringContainsString('Solo A', $html);
        $this->assertStringNotContainsString('Solo B', $html);
    }

    public function test_admin_dashboard_shows_all_recent_tasks(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $u = User::factory()->create(['role' => 'funcionario']);

        $p = Project::create(['name' => 'P', 'code' => 'X-001', 'user_id' => $u->id]);
        Task::create([
            'title' => 'De otro usuario',
            'description' => null,
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => null,
            'order' => 0,
            'project_id' => $p->id,
            'assigned_to' => $u->id,
            'created_by' => $u->id,
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('De otro usuario', false);
    }
}
