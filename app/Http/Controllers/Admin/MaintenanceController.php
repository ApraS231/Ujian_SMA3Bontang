<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        // Hitung jumlah sesi yang ID ujiannya tidak ada di tabel exams
        $orphanCount = ExamSession::whereNotIn('exam_id', DB::table('exams')->pluck('id'))->count();
        return view('admin.maintenance.index', compact('orphanCount'));
    }

    public function cleanOrphanSessions()
    {
        // Ambil semua ID ujian yang valid
        $existingExamIds = DB::table('exams')->pluck('id');

        // Hapus semua sesi yang exam_id-nya tidak ada di daftar ID yang valid
        $deletedCount = ExamSession::whereNotIn('exam_id', $existingExamIds)->delete();

        if ($deletedCount > 0) {
            return redirect()->route('admin.maintenance.index')->with('success', $deletedCount . ' sesi ujian yang rusak berhasil dibersihkan.');
        }

        return redirect()->route('admin.maintenance.index')->with('info', 'Tidak ada data rusak yang perlu dibersihkan.');
    }
}

