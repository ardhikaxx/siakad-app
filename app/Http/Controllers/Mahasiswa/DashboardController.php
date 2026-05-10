<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalEnrollment = $user->enrollments()->count();
        $totalSks = $user->enrollments()->with('schedule.course')->get()
            ->sum(fn($e) => $e->schedule->course->credits ?? 0);
        return view('mahasiswa.dashboard.index', compact('totalEnrollment', 'totalSks'));
    }
}
