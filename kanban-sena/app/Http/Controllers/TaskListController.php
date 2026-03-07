<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Task::with(['project', 'assignee', 'creator']);

        if (!$user->isAdmin() && !$user->isCoordinador()) {
            $query->where(function ($query) use ($user) {
                $query->where('assigned_to', $user->id)->orWhere('created_by', $user->id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $tasks = $query->latest()->paginate(15);

        return view('tasks.list', compact('tasks'));
    }
}
