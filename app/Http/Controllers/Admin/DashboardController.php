<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'       => User::count(),
            'courses'     => Course::count(),
            'rooms'       => Room::count(),
            'schedules'   => Schedule::count(),
            'enrollments' => Enrollment::count(),
        ];
        return view('admin.dashboard.index', compact('stats'));
    }
}
