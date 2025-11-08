<?php
// =====================================================================
// BARU: Controller untuk Manajemen Ruangan (RoomController)
// =====================================================================
// File: app/Http/Controllers/Admin/RoomController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms',
            'capacity' => 'required|integer|min:1',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        // Tambahkan validasi jika ruangan sedang dipakai sesi ujian
        if ($room->examSessions()->exists()) {
            return back()->with('error', 'Ruangan tidak dapat dihapus karena sedang digunakan dalam sesi ujian.');
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
