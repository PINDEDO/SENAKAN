<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskStatusChanged;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $project = Project::findOrFail($validated['project_id']);
        $this->authorize('addTask', $project);

        $validated['created_by'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['order'] = Task::where('project_id', $validated['project_id'])
            ->where('status', 'pending')
            ->count();

        $task = Task::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'action' => 'created',
            'description' => "Creó la tarea: {$task->title}",
        ]);

        if (! empty($validated['assigned_to']) && (int) $validated['assigned_to'] !== (int) Auth::id()) {
            User::find($validated['assigned_to'])?->notify(new TaskAssigned($task));
        }

        return redirect()->back()->with('success', 'Tarea creada exitosamente.');
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $previousAssignee = $task->assigned_to;

        $task->update($validated);

        if (($task->assigned_to ?? null) != $previousAssignee && $task->assigned_to
            && (int) $task->assigned_to !== (int) Auth::id()) {
            User::find($task->assigned_to)?->notify(new TaskAssigned($task->fresh()));
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'action' => 'updated',
            'description' => "Actualizó la información de la tarea: {$task->title}",
        ]);

        return redirect()->back()->with('success', 'Tarea actualizada exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,progress,done',
            'order' => 'required|integer',
        ]);

        $task = Task::findOrFail($request->task_id);
        $this->authorize('update', $task);

        $oldStatus = $task->status;

        $task->update([
            'status' => $request->status,
            'order' => $request->order,
        ]);

        if ($oldStatus !== $request->status) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'task_id' => $task->id,
                'action' => 'status_change',
                'description' => "Cambió el estado de '{$oldStatus}' a '{$request->status}' para la tarea: {$task->title}",
            ]);

            $task->refresh();
            $actor = Auth::user();
            $recipientIds = collect([$task->assigned_to, $task->created_by])
                ->filter()
                ->unique()
                ->reject(fn ($id) => (int) $id === (int) $actor->id);

            foreach ($recipientIds as $userId) {
                User::find($userId)?->notify(
                    new TaskStatusChanged($task, $oldStatus, $request->status, $actor)
                );
            }
        }

        return response()->json(['success' => true]);
    }
}
