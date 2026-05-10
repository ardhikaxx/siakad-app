<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['course', 'room'])
            ->where('lecturer_id', Auth::id())
            ->orderBy('day')->orderBy('start_time')
            ->paginate(15);
        return view('dosen.schedules.index', compact('schedules'));
    }

    public function students(Schedule $schedule)
    {
        // Pastikan jadwal ini milik dosen yang login
        if ($schedule->lecturer_id !== Auth::id()) {
            abort(403);
        }
        $schedule->load(['course', 'room', 'enrollments.student']);
        return view('dosen.schedules.students', compact('schedule'));
    }
}
