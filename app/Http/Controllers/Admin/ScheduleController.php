<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Room;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['course', 'lecturer', 'room'])
            ->latest()->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $courses  = Course::orderBy('name')->get();
        $rooms    = Room::orderBy('name')->get();
        $lecturers = User::whereHas('role', fn($q) => $q->where('name', 'dosen'))
            ->orderBy('name')->get();
        return view('admin.schedules.create', compact('courses', 'rooms', 'lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:users,id',
            'room_id'     => 'required|exists:rooms,id',
            'day'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'semester'    => 'required|string|max:20',
        ]);

        if ($this->cekBentrokDosen($request)) {
            return back()->with('error', 'Dosen sudah memiliki jadwal di waktu tersebut.')->withInput();
        }
        if ($this->cekBentrokRuangan($request)) {
            return back()->with('error', 'Ruangan sudah digunakan di waktu tersebut.')->withInput();
        }

        Schedule::create($request->only('course_id','lecturer_id','room_id','day','start_time','end_time','semester'));
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $courses   = Course::orderBy('name')->get();
        $rooms     = Room::orderBy('name')->get();
        $lecturers = User::whereHas('role', fn($q) => $q->where('name', 'dosen'))
            ->orderBy('name')->get();
        return view('admin.schedules.edit', compact('schedule', 'courses', 'rooms', 'lecturers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:users,id',
            'room_id'     => 'required|exists:rooms,id',
            'day'         => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'semester'    => 'required|string|max:20',
        ]);

        if ($this->cekBentrokDosen($request, $schedule->id)) {
            return back()->with('error', 'Dosen sudah memiliki jadwal di waktu tersebut.')->withInput();
        }
        if ($this->cekBentrokRuangan($request, $schedule->id)) {
            return back()->with('error', 'Ruangan sudah digunakan di waktu tersebut.')->withInput();
        }

        $schedule->update($request->only('course_id','lecturer_id','room_id','day','start_time','end_time','semester'));
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->enrollments()->delete();
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function enrollments(Schedule $schedule)
    {
        $schedule->load(['course', 'lecturer', 'room', 'enrollments.student']);
        return view('admin.schedules.enrollments', compact('schedule'));
    }

    private function cekBentrokDosen(Request $request, ?int $excludeId = null): bool
    {
        return Schedule::where('lecturer_id', $request->lecturer_id)
            ->where('day', $request->day)
            ->where('semester', $request->semester)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->where(function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                       ->where('end_time', '>', $request->start_time);
                });
            })->exists();
    }

    private function cekBentrokRuangan(Request $request, ?int $excludeId = null): bool
    {
        return Schedule::where('room_id', $request->room_id)
            ->where('day', $request->day)
            ->where('semester', $request->semester)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->where(function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                       ->where('end_time', '>', $request->start_time);
                });
            })->exists();
    }
}
