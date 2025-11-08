<?php

/*
|--------------------------------------------------------------------------
| 1. Perbarui ReportController
|--------------------------------------------------------------------------
|
| Kita akan memastikan semua relasi yang dibutuhkan (terutama 'exam')
| dimuat dengan benar sebelum data dikirim ke view.
|
*/

// File: app/Http/Controllers/Admin/ReportController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        // Eager load semua relasi yang dibutuhkan di halaman index
        $sessions = ExamSession::with(['exam', 'room', 'supervisor'])->latest()->paginate(10);
        return view('admin.reports.index', compact('sessions'));
    }

    public function show(ExamSession $session)
    {
        // Eager load semua relasi yang dibutuhkan untuk halaman detail
        $session->load(['exam', 'room', 'supervisor', 'attendances', 'eventNotes']);
        
        // PERBAIKAN: Tambahkan pengecekan jika relasi exam tidak ada
        if (!$session->exam) {
            return redirect()->route('admin.reports.index')->with('error', 'Gagal melihat laporan: Data ujian untuk sesi ini tidak ditemukan atau telah dihapus.');
        }

        $hadir = $session->attendances->where('status', 'hadir')->count();
        $tidak_hadir = $session->attendances->where('status', 'tidak hadir')->count();
        $total_peserta = $session->attendances->count();

        return view('admin.reports.show', compact('session', 'hadir', 'tidak_hadir', 'total_peserta'));
    }

    public function printReport(ExamSession $session)
    {
        $session->load(['exam', 'room', 'supervisor', 'attendances', 'eventNotes']);
        
        // PERBAIKAN: Tambahkan pengecekan yang sama untuk fungsi cetak
        if (!$session->exam) {
            return redirect()->route('admin.reports.index')->with('error', 'Gagal mencetak laporan: Data ujian untuk sesi ini tidak ditemukan atau telah dihapus.');
        }
        
        $hadir = $session->attendances->where('status', 'hadir')->count();
        $tidak_hadir = $session->attendances->where('status', 'tidak hadir')->count();
        $total_peserta = $session->attendances->count();

        $pdf = PDF::loadView('admin.reports.report-template', compact('session', 'hadir', 'tidak_hadir', 'total_peserta'));
        
        return $pdf->stream('berita-acara-' . $session->exam->subject . '.pdf');
    }
}