<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['schedule.course', 'schedule.lecturer', 'schedule.room'])
            ->where('student_id', Auth::id())
            ->latest()->paginate(15);
        return view('mahasiswa.enrollments.index', compact('enrollments'));
    }

    public function store(Schedule $schedule)
    {
        $user = Auth::user();

        // Cek sudah terdaftar
        if (Enrollment::where('schedule_id', $schedule->id)->where('student_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di jadwal ini.');
        }

        // Cek bentrok jadwal
        $mySchedules = $user->enrollments()->with('schedule')->get()->pluck('schedule');
        foreach ($mySchedules as $s) {
            if (
                $s->day === $schedule->day &&
                $s->semester === $schedule->semester &&
                $s->start_time < $schedule->end_time &&
                $s->end_time > $schedule->start_time
            ) {
                return back()->with('error', 'Jadwal bentrok dengan mata kuliah ' . $s->course->name . '.');
            }
        }

        Enrollment::create([
            'schedule_id' => $schedule->id,
            'student_id'  => $user->id,
        ]);

        return back()->with('success', 'Berhasil mendaftar ke jadwal ' . $schedule->course->name . '.');
    }

    public function destroy(Schedule $schedule)
    {
        $enrollment = Enrollment::where('schedule_id', $schedule->id)
            ->where('student_id', Auth::id())
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'Enrollment tidak ditemukan.');
        }

        $enrollment->delete();
        return back()->with('success', 'Enrollment berhasil dibatalkan.');
    }
}
