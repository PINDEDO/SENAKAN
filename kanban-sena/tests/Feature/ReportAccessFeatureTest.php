<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportAccessFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_reports(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('reports.index'))
            ->assertOk()
            ->assertSee('Informe de Gestión', false);
    }

    public function test_funcionario_cannot_open_reports(): void
    {
        $user = User::factory()->create(['role' => 'funcionario']);

        $this->actingAs($user)
            ->get(route('reports.index'))
            ->assertForbidden();
    }
}
