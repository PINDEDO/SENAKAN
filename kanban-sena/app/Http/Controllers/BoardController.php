<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $projects = Project::visibleToUser($user)->latest()->get();

        $projectId = $request->get('project_id');
        if (! $projectId && $projects->isNotEmpty()) {
            $projectId = $projects->first()->id;
        }

        $currentProject = $projectId
            ? Project::visibleToUser($user)->with(['tasks' => function ($q) use ($user) {
                $q->with('assignee')->orderBy('order');
                if (! $user->isAdmin() && ! $user->isCoordinador()) {
                    $q->where(function ($sub) use ($user) {
                        $sub->where('assigned_to', $user->id)->orWhere('created_by', $user->id);
                    });
                }
            }])->find($projectId)
            : null;

        $tasks = [
            'pending' => $currentProject ? $currentProject->tasks->where('status', 'pending') : collect(),
            'progress' => $currentProject ? $currentProject->tasks->where('status', 'progress') : collect(),
            'done' => $currentProject ? $currentProject->tasks->where('status', 'done') : collect(),
        ];

        if ($user->isAdmin() || $user->isCoordinador()) {
            $users = User::where('active', true)->get();
        } else {
            $users = collect([$user]);
        }

        return view('board', compact('projects', 'currentProject', 'tasks', 'users'));
    }
}
