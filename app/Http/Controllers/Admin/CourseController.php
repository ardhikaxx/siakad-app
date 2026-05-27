<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:150',
            'code'    => 'required|string|max:20|unique:courses',
            'credits' => 'required|integer|min:1|max:6',
            'semester'=> 'required|string|max:20',
        ]);

        Course::create($request->only('name', 'code', 'credits', 'semester'));
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name'    => 'required|string|max:150',
            'code'    => ['required','string','max:20', Rule::unique('courses')->ignore($course->id)],
            'credits' => 'required|integer|min:1|max:6',
            'semester'=> 'required|string|max:20',
        ]);

        $course->update($request->only('name', 'code', 'credits', 'semester'));
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        if ($course->schedules()->exists()) {
            return back()->with('error', 'Mata kuliah tidak bisa dihapus karena masih memiliki jadwal.');
        }

        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
