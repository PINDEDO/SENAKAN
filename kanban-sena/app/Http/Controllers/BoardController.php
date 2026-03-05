<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::latest()->get();
        $projectId = $request->get('project_id');

        if (!$projectId && $projects->isNotEmpty()) {
            $projectId = $projects->first()->id;
        }

        $currentProject = $projectId ?Project::with(['tasks' => function ($q) {
            $q->with('assignee')->orderBy('order');
        }])->find($projectId) : null;

        $tasks = [
            'pending' => $currentProject ? $currentProject->tasks->where('status', 'pending') : collect(),
            'progress' => $currentProject ? $currentProject->tasks->where('status', 'progress') : collect(),
            'done' => $currentProject ? $currentProject->tasks->where('status', 'done') : collect(),
        ];

        $users = User::where('active', true)->get();

        return view('board', compact('projects', 'currentProject', 'tasks', 'users'));
    }
}
