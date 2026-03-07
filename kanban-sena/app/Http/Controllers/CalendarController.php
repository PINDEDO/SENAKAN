<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $startOfCalendar = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

        $user = auth()->user();
        $query = Task::with('project')
            ->whereBetween('due_date', [$startOfCalendar, $endOfCalendar]);

        if (!$user->isAdmin() && !$user->isCoordinador()) {
            $query->where(function ($query) use ($user) {
                $query->where('assigned_to', $user->id)->orWhere('created_by', $user->id);
            });
        }

        $tasks = $query->get()
            ->groupBy(function ($task) {
            return $task->due_date->format('Y-m-d');
        });

        return view('calendar', compact('tasks', 'startOfMonth', 'startOfCalendar', 'endOfCalendar'));
    }
}
