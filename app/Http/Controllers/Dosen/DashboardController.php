<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalJadwal    = $user->schedules()->count();
        $totalMahasiswa = $user->schedules()->withCount('enrollments')->get()->sum('enrollments_count');
        return view('dosen.dashboard.index', compact('totalJadwal', 'totalMahasiswa'));
    }
}
