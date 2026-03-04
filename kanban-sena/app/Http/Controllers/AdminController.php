<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $metrics = [
            'total_users' => User::count(),
            'active_users' => User::where('active', 1)->count(),
            'total_tasks' => 0, // Placeholder
        ];

        return view('dashboard', compact('metrics'));
    }
}
