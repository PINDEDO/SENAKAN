<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $projects = Project::withCount(['tasks', 'tasks as completed_tasks_count' => function ($q) {
            $q->where('status', 'done');
        }])->get();

        $total_tasks = Task::count();
        $task_distribution = [
            'pending' => $total_tasks > 0 ? round((Task::where('status', 'pending')->count() / $total_tasks) * 100) : 0,
            'progress' => $total_tasks > 0 ? round((Task::where('status', 'progress')->count() / $total_tasks) * 100) : 0,
            'done' => $total_tasks > 0 ? round((Task::where('status', 'done')->count() / $total_tasks) * 100) : 0,
        ];

        $recent_activities = Task::with(['project', 'creator'])
            ->latest('updated_at')
            ->take(10)
            ->get();

        return view('reports.index', compact('projects', 'task_distribution', 'recent_activities'));
    }
}
