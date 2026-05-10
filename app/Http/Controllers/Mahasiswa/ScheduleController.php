<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $semester = $request->get('semester');
        $user = Auth::user();

        $enrolledIds = $user->enrollments()->pluck('schedule_id');

        $query = Schedule::with(['course', 'lecturer', 'room'])
            ->withCount('enrollments');

        if ($semester) {
            $query->where('semester', $semester);
        }

        $schedules = $query->orderBy('day')->orderBy('start_time')->paginate(15);

        $semesters = Schedule::distinct()->pluck('semester');

        return view('mahasiswa.schedules.index', compact('schedules', 'enrolledIds', 'semesters', 'semester'));
    }
}
