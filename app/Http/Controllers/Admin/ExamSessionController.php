<?php

/*
|--------------------------------------------------------------------------
| 1. Perbarui ExamSessionController
|--------------------------------------------------------------------------
|
| Controller ini dirombak untuk menangani logika pengelompokan siswa
| per kelas dan pembagian sesi secara otomatis.
|
*/

// File: app/Http/Controllers/Admin/ExamSessionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use App\Models\Exam;
use App\Models\Room;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ExamSessionController extends Controller
{
    public function index()
    {
        $sessions = ExamSession::with(['exam', 'room', 'supervisor'])->latest()->paginate(10);
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        // Ambil data yang dibutuhkan untuk form
        $exams = Exam::orderBy('exam_date', 'desc')->get();
        $rooms = Room::orderBy('name')->get();
        $supervisors = User::where('role', 'pengawas')->orderBy('name')->get();
        
        // BARU: Ambil daftar kelas unik dari tabel siswa
        $classes = Student::select('class')->distinct()->orderBy('class')->pluck('class');

        return view('admin.sessions.create', compact('exams', 'rooms', 'supervisors', 'classes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'class' => 'required|string', // Sekarang kita menerima nama kelas
            'room_id' => 'required|exists:rooms,id',
            'supervisor_id' => 'required|exists:users,id',
            'session_times' => 'required|string', // Menerima satu atau lebih waktu sesi
        ]);

        // 2. Ambil data siswa dan ruangan
        $students = Student::where('class', $request->class)->orderBy('name')->get();
        $room = Room::findOrFail($request->room_id);

        if ($students->isEmpty()) {
            return back()->with('error', 'Tidak ada siswa yang ditemukan untuk kelas ' . $request->class)->withInput();
        }

        // 3. Proses waktu sesi
        $sessionTimes = array_map('trim', explode(',', $request->session_times));

        // 4. Bagi siswa ke dalam beberapa kelompok (chunk) berdasarkan kapasitas ruangan
        $studentChunks = $students->chunk($room->capacity);

        // 5. Validasi apakah jumlah sesi yang dibutuhkan melebihi waktu yang disediakan
        if ($studentChunks->count() > count($sessionTimes)) {
            return back()->with('error', 'Jumlah sesi yang dibutuhkan (' . $studentChunks->count() . ') melebihi jumlah waktu sesi yang disediakan (' . count($sessionTimes) . '). Silakan tambahkan waktu sesi.')->withInput();
        }

        $createdSessionsCount = 0;
        // 6. Loop untuk setiap kelompok siswa dan buat sesi
        foreach ($studentChunks as $index => $studentChunk) {
            // Buat Sesi Ujian baru
            $session = ExamSession::create([
                'exam_id' => $request->exam_id,
                'room_id' => $request->room_id,
                'supervisor_id' => $request->supervisor_id,
                'session_time' => $sessionTimes[$index], // Ambil waktu sesi sesuai urutan
            ]);

            // 7. Alokasikan siswa dari kelompok ini ke sesi yang baru dibuat
            $tableNumber = 1;
            foreach ($studentChunk as $student) {
                Attendance::create([
                    'exam_session_id' => $session->id,
                    'student_id' => $student->id,
                    'table_number' => $tableNumber++,
                ]);
            }
            $createdSessionsCount++;
        }

        return redirect()->route('admin.sessions.index')->with('success', $createdSessionsCount . ' sesi ujian berhasil dibuat untuk kelas ' . $request->class . '.');
    }

    // Method lainnya (show, destroy) tetap sama ...
    public function show(ExamSession $session)
    {
        $session->load(['attendances.student']);
        return view('admin.sessions.show', compact('session'));
    }

    public function destroy(ExamSession $session)
    {
        $session->attendances()->delete();
        $session->delete();
        return redirect()->route('admin.sessions.index')->with('success', 'Sesi ujian berhasil dihapus.');
    }
}
