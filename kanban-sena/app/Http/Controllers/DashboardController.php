<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Métricas placeholder para el MVP
        $metrics = [
            'total_tasks' => 0,
            'completed_tasks' => 0,
            'overdue_tasks' => 0,
            'total_users' => User::count(),
        ];

        return view('dashboard', compact('metrics'));
    }
}
