namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
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

        $validated['created_by'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['order'] = Task::where('project_id', $validated['project_id'])
            ->where('status', 'pending')
            ->count();

        Task::create($validated);

        return redirect()->back()->with('success', 'Tarea creada exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,progress,done',
            'order' => 'required|integer',
        ]);

        $task = Task::findOrFail($request->task_id);
        
        $task->update([
            'status' => $request->status,
            'order' => $request->order
        ]);

        return response()->json(['success' => true]);
    }
}
