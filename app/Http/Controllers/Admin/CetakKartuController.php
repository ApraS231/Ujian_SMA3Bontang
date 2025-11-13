<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakKartuController extends Controller
{
    /**
     * Menampilkan halaman untuk memilih sesi mana yang akan dicetak.
     */
    public function index()
    {
        $examSessions = ExamSession::with('subject')->latest()->get();
        return view('admin.cetak-kartu.index', compact('examSessions'));
    }

    /**
     * Mencetak kartu ujian untuk sesi yang dipilih.
     */
    public function print(ExamSession $examSession)
    {
        $examSession->load('examCards.student', 'examCards.room');

        if ($examSession->examCards->isEmpty()) {
            return back()->with('error', 'Tidak ada kartu ujian yang bisa dicetak untuk sesi ini.');
        }

        $cardsByRoom = $examSession->examCards->groupBy('room.name');

        $pdf = PDF::loadView('admin.cetak-kartu.template', compact('examSession', 'cardsByRoom'));

        return $pdf->stream('kartu-ujian-' . $examSession->subject->subject . '.pdf');
    }
}
