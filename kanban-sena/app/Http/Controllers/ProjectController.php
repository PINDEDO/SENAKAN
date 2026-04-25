<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::visibleToUser(Auth::user())
            ->with('creator')
            ->withCount('tasks')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:projects,code|max:50',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['user_id'] = Auth::id();
        Project::create($validated);

        return redirect()->back()->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:projects,code,'.$project->id.'|max:50',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ]);

        $project->update($validated);

        return redirect()->back()->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->back()->with('success', 'Proyecto eliminado.');
    }
}
