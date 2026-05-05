<?php

namespace App\Http\Controllers;

use App\Exports\InstitutionalReportExport;
use App\Models\Project;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAdministrativeReports', $request->user());

        return view('reports.index', $this->reportPayload($request));
    }

    public function exportPdf(Request $request)
    {
        $this->authorize('viewAdministrativeReports', $request->user());

        $payload = $this->reportPayload($request);
        $payload['generatedAt'] = now()->format('d/m/Y H:i');
        $payload['generatedBy'] = $request->user()->name;

        $filename = 'informe-sena-'.now()->format('Y-m-d_His').'.pdf';

        return Pdf::loadView('reports.pdf', $payload)
            ->setPaper('a4', 'portrait')
            ->download($filename);
    }

    public function exportExcel(Request $request)
    {
        $this->authorize('viewAdministrativeReports', $request->user());

        $payload = $this->reportPayload($request);
        $generatedAt = now()->format('d/m/Y H:i');

        $filename = 'informe-sena-'.now()->format('Y-m-d_His').'.xlsx';

        return Excel::download(
            new InstitutionalReportExport(
                $payload['task_distribution'],
                $payload['projects'],
                $payload['recent_activities'],
                $generatedAt
            ),
            $filename
        );
    }

    /**
     * @return array{projects: \Illuminate\Support\Collection, task_distribution: array{pending: int, progress: int, done: int}, recent_activities: \Illuminate\Support\Collection}
     */
    private function reportPayload(Request $request): array
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

        return compact('projects', 'task_distribution', 'recent_activities');
    }
}
