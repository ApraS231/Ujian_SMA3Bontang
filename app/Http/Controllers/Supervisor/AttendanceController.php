<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use App\Models\Attendance;
use App\Models\EventNote;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function show(ExamSession $exam_session)
    {
        // Eager load relasi untuk efisiensi query
        $exam_session->load(['exam', 'room', 'attendances.student', 'eventNotes']);

        $attendances = $exam_session->attendances()->with('student')->orderBy('table_number')->get();

        return view('supervisor.attendance.show', compact('exam_session', 'attendances'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'status' => 'required|in:hadir,tidak hadir',
        ]);

        $attendance = Attendance::find($request->attendance_id);
        $attendance->status = $request->status;
        $attendance->attended_at = now();
        $attendance->save();

        return back()->with('success', 'Kehadiran siswa berhasil diperbarui.');
    }

    public function storeNote(Request $request)
    {
        $request->validate([
            'exam_session_id' => 'required|exists:exam_sessions,id',
            'note' => 'required|string',
        ]);

        EventNote::create([
            'exam_session_id' => $request->exam_session_id,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Catatan kejadian berhasil disimpan.');
    }
}

?>