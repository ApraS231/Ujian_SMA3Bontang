<?php
// =====================================================================
// Controller untuk Manajemen Ujian (ExamController)
// =====================================================================
// File: app/Http/Controllers/Admin/ExamController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        Exam::create($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'Jadwal ujian berhasil ditambahkan.');
    }

    public function edit(Exam $exam)
    {
        return view('admin.exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $exam->update($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'Jadwal ujian berhasil diperbarui.');
    }

    public function destroy(Exam $exam)
    {
        // Cek apakah ujian ini memiliki sesi yang terhubung.
        if ($exam->examSessions()->exists()) {
            // Jika ada, jangan hapus dan kembalikan pesan error.
            return back()->with('error', 'Ujian tidak dapat dihapus karena masih digunakan oleh satu atau lebih sesi ujian. Silakan hapus sesi-sesinya terlebih dahulu.');
        }

        // Jika tidak ada sesi yang terhubung, baru hapus ujian.
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'Jadwal ujian berhasil dihapus.');
    }
    public function showSessionsForPrinting(Exam $exam)
    {
        // Eager load relasi untuk efisiensi
        $exam->load(['examSessions.room', 'examSessions.supervisor']);

        return view('admin.exams.show-sessions', compact('exam'));
    }
    public function printAllCardsForExam(Exam $exam)
    {
        // Eager load relasi baru
        $exam->load('kartuUjians.student', 'kartuUjians.room');

        // Periksa jika tidak ada kartu ujian sama sekali untuk ujian ini
        if ($exam->kartuUjians->isEmpty()) {
            return back()->with('error', 'Tidak ada kartu ujian yang bisa dicetak untuk ujian ini. Silakan buat melalui wizard terlebih dahulu.');
        }

        // Kelompokkan kartu ujian berdasarkan ruangan
        $cardsByRoom = $exam->kartuUjians->groupBy('room_id');

        // Generate PDF dari view, dengan mengirimkan data yang sudah dikelompokkan
        $pdf = PDF::loadView('admin.exams.print-all-cards-template', compact('exam', 'cardsByRoom'));

        // Tampilkan PDF di browser
        return $pdf->stream('kartu-peserta-ujian-' . $exam->subject . '.pdf');
    }
    public function printAllReportsForExam(Exam $exam)
    {
        // Eager load semua relasi yang dibutuhkan dalam satu query
        $exam->load([
            'examSessions.room',
            'examSessions.supervisor',
            'examSessions.attendances',
            'examSessions.eventNotes'
        ]);

        // Periksa jika tidak ada sesi sama sekali untuk ujian ini
        if ($exam->examSessions->isEmpty()) {
            return back()->with('error', 'Tidak ada laporan yang bisa dicetak untuk ujian ini. Silakan buat sesi terlebih dahulu.');
        }

        // Generate PDF dari view, dengan mengirimkan seluruh data ujian
        $pdf = PDF::loadView('admin.exams.print-all-reports-template', compact('exam'));

        // Tampilkan PDF di browser
        return $pdf->stream('semua-laporan-' . $exam->subject . '.pdf');
    }
}
