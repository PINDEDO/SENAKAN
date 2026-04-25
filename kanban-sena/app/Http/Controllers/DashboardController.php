<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', static::dashboardPayload(Auth::user()));
    }

    /**
     * @return array{metrics: array<string, int>, recent_tasks: \Illuminate\Support\Collection, active_projects: \Illuminate\Support\Collection}
     */
    public static function dashboardPayload(User $user): array
    {
        $taskQuery = Task::query();
        $projectQuery = Project::query();

        if (! $user->isAdmin() && ! $user->isCoordinador()) {
            $taskQuery->visibleToUser($user);
            $projectQuery->visibleToUser($user);
        }

        $metrics = [
            'total_tasks' => (clone $taskQuery)->count(),
            'completed_tasks' => (clone $taskQuery)->where('status', 'done')->count(),
            'overdue_tasks' => (clone $taskQuery)->where('status', '!=', 'done')
                ->whereNotNull('due_date')
                ->whereDate('due_date', '<', now()->toDateString())
                ->count(),
            'total_projects' => (clone $projectQuery)->count(),
        ];

        $recent_tasks = (clone $taskQuery)->with(['project', 'assignee'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $active_projects = (clone $projectQuery)->withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($q) {
                $q->where('status', 'done');
            },
        ])->latest()->take(3)->get();

        return compact('metrics', 'recent_tasks', 'active_projects');
    }
}
