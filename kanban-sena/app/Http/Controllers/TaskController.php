<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        Log::info('Intentando crear tarea:', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'project_id' => 'required|exists:projects,id',
                'priority' => 'required|in:low,medium,high',
                'due_date' => 'nullable|date',
                'assigned_to' => 'nullable|exists:users,id',
            ]);
        }
        catch (\Exception $e) {
            Log::error('Validación de tarea fallida:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Error de validación: ' . $e->getMessage()])->withInput();
        }

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
            'description' => "Creó la tarea: {$task->title}"
        ]);

        return redirect()->back()->with('success', 'Tarea creada exitosamente.');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'action' => 'updated',
            'description' => "Actualizó la información de la tarea: {$task->title}"
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
        $oldStatus = $task->status;

        $task->update([
            'status' => $request->status,
            'order' => $request->order
        ]);

        if ($oldStatus !== $request->status) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'task_id' => $task->id,
                'action' => 'status_change',
                'description' => "Cambió el estado de '{$oldStatus}' a '{$request->status}' para la tarea: {$task->title}"
            ]);
        }

        return response()->json(['success' => true]);
    }
}
