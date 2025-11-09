<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Room;
use App\Models\KartuUjian;
use App\Models\EventNote;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Menampilkan halaman absensi untuk ujian dan ruangan tertentu.
     */
    public function show(Exam $exam, Room $room)
    {
        // Ambil semua kartu ujian (siswa) untuk ujian dan ruangan ini
        $kartuUjians = KartuUjian::where('exam_id', $exam->id)
                                ->where('room_id', $room->id)
                                ->with('student')
                                ->orderBy('seat_number')
                                ->get();

        // Ambil catatan kejadian yang sudah ada
        $eventNotes = EventNote::where('exam_id', $exam->id)
                               ->where('room_id', $room->id)
                               ->latest()
                               ->get();

        return view('supervisor.attendance.show', compact('exam', 'room', 'kartuUjians', 'eventNotes'));
    }

    /**
     * Memperbarui status kehadiran untuk sebuah KartuUjian.
     */
    public function update(Request $request, KartuUjian $kartuUjian)
    {
        $request->validate([
            'status' => 'required|in:hadir,tidak hadir',
        ]);

        $kartuUjian->status = $request->status;
        if ($request->status == 'hadir') {
            $kartuUjian->attended_at = now();
        } else {
            $kartuUjian->attended_at = null;
        }
        $kartuUjian->save();

        return back()->with('success', 'Kehadiran siswa berhasil diperbarui.');
    }

    /**
     * Menyimpan catatan kejadian baru.
     */
    public function storeNote(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'room_id' => 'required|exists:rooms,id',
            'note' => 'required|string',
        ]);

        EventNote::create($request->all());

        return back()->with('success', 'Catatan kejadian berhasil disimpan.');
    }
}
