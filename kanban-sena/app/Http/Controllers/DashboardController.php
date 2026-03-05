<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'total_tasks' => Task::count(),
            'completed_tasks' => Task::where('status', 'done')->count(),
            'overdue_tasks' => Task::where('status', '!=', 'done')
            ->where('due_date', '<', now()->toDateString())
            ->count(),
            'total_users' => User::count(),
            'total_projects' => Project::count(),
        ];

        $recent_tasks = Task::with(['project', 'assignee'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $active_projects = Project::withCount(['tasks', 'tasks as completed_tasks_count' => function ($q) {
            $q->where('status', 'done');
        }])->latest()->take(3)->get();

        return view('dashboard', compact('metrics', 'recent_tasks', 'active_projects'));
    }
}
