<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(15);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create($request->only('name', 'capacity'));
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($request->only('name', 'capacity'));
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->schedules()->exists()) {
            return back()->with('error', 'Ruangan tidak bisa dihapus karena masih digunakan dalam jadwal.');
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
