<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Schedule $schedule, Meeting $meeting)
    {
        if ($schedule->lecturer_id !== Auth::id() || $meeting->schedule_id !== $schedule->id) {
            abort(403);
        }

        $attendances = $meeting->attendances()->with('student')->get();
        return view('dosen.attendances.index', compact('schedule', 'meeting', 'attendances'));
    }

    public function update(Request $request, Schedule $schedule, Meeting $meeting)
    {
        if ($schedule->lecturer_id !== Auth::id() || $meeting->schedule_id !== $schedule->id) {
            abort(403);
        }

        $request->validate([
            'attendances'   => 'required|array',
            'attendances.*' => 'required|in:Hadir,Ijin,Alpa',
        ]);

        foreach ($request->attendances as $attendanceId => $status) {
            Attendance::where('id', $attendanceId)
                ->where('meeting_id', $meeting->id)
                ->update(['status' => $status]);
        }

        return redirect()->route('dosen.meetings.index', $schedule)->with('success', 'Presensi berhasil diperbarui.');
    }
}
