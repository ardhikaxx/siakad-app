<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    public function index(Schedule $schedule)
    {
        if ($schedule->lecturer_id !== Auth::id()) {
            abort(403);
        }

        $meetings = $schedule->meetings()->orderBy('date', 'desc')->paginate(10);
        return view('dosen.meetings.index', compact('schedule', 'meetings'));
    }

    public function store(Request $request, Schedule $schedule)
    {
        if ($schedule->lecturer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'date'  => 'required|date',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $schedule) {
            $meeting = $schedule->meetings()->create([
                'title' => $request->title,
                'date'  => $request->date,
                'description' => $request->description,
            ]);

            // Auto-generate attendance records for all enrolled students
            $students = $schedule->students;
            foreach ($students as $student) {
                Attendance::create([
                    'meeting_id' => $meeting->id,
                    'student_id' => $student->id,
                    'status'     => 'Hadir', // Default status
                ]);
            }
        });

        return back()->with('success', 'Pertemuan berhasil dibuat dan daftar presensi telah disiapkan.');
    }

    public function destroy(Schedule $schedule, Meeting $meeting)
    {
        if ($schedule->lecturer_id !== Auth::id() || $meeting->schedule_id !== $schedule->id) {
            abort(403);
        }

        $meeting->delete();
        return back()->with('success', 'Pertemuan berhasil dihapus.');
    }
}
