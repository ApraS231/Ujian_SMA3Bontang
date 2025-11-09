<?php
// =====================================================================
// Controller untuk Manajemen Ujian (UjianController)
// =====================================================================
// File: app/Http/Controllers/Admin/UjianController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::latest()->paginate(10);
        return view('admin.ujians.index', compact('ujians'));
    }

    public function create()
    {
        return view('admin.ujians.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        Ujian::create($request->all());

        return redirect()->route('admin.ujians.index')->with('success', 'Jadwal ujian berhasil ditambahkan.');
    }

    public function edit(Ujian $ujian)
    {
        return view('admin.ujians.edit', compact('ujian'));
    }

    public function update(Request $request, Ujian $ujian)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $ujian->update($request->all());

        return redirect()->route('admin.ujians.index')->with('success', 'Jadwal ujian berhasil diperbarui.');
    }

    public function destroy(Ujian $ujian)
    {
        // Cek apakah ujian ini memiliki sesi yang terhubung.
        if ($ujian->sesiUjians()->exists()) {
            // Jika ada, jangan hapus dan kembalikan pesan error.
            return back()->with('error', 'Ujian tidak dapat dihapus karena masih digunakan oleh satu atau lebih sesi ujian. Silakan hapus sesi-sesinya terlebih dahulu.');
        }

        // Jika tidak ada sesi yang terhubung, baru hapus ujian.
        $ujian->delete();
        return redirect()->route('admin.ujians.index')->with('success', 'Jadwal ujian berhasil dihapus.');
    }
    public function showSessionsForPrinting(Ujian $ujian)
    {
        // Eager load relasi untuk efisiensi
        $ujian->load(['sesiUjians.ruang', 'sesiUjians.supervisor']);

        return view('admin.ujians.show-sessions', compact('ujian'));
    }
    public function printAllCardsForUjian(Ujian $ujian)
    {
        // Eager load semua relasi yang dibutuhkan dalam satu query
        $ujian->load([
            'sesiUjians.ruang',
            'sesiUjians.supervisor',
            'sesiUjians.kartuUjians.siswa'
        ]);

        // Periksa jika tidak ada sesi sama sekali untuk ujian ini
        if ($ujian->sesiUjians->isEmpty()) {
            return back()->with('error', 'Tidak ada sesi yang bisa dicetak untuk ujian ini. Silakan buat sesi terlebih dahulu.');
        }

        // Generate PDF dari view, dengan mengirimkan seluruh data ujian
        $pdf = PDF::loadView('admin.ujians.print-all-cards-template', compact('ujian'));

        // Tampilkan PDF di browser
        return $pdf->stream('semua-kartu-ujian-' . $ujian->subject . '.pdf');
    }
    public function printAllReportsForUjian(Ujian $ujian)
    {
        // Eager load semua relasi yang dibutuhkan dalam satu query
        $ujian->load([
            'sesiUjians.ruang',
            'sesiUjians.supervisor',
            'sesiUjians.kartuUjians',
            'sesiUjians.eventNotes'
        ]);

        // Periksa jika tidak ada sesi sama sekali untuk ujian ini
        if ($ujian->sesiUjians->isEmpty()) {
            return back()->with('error', 'Tidak ada laporan yang bisa dicetak untuk ujian ini. Silakan buat sesi terlebih dahulu.');
        }

        // Generate PDF dari view, dengan mengirimkan seluruh data ujian
        $pdf = PDF::loadView('admin.ujians.print-all-reports-template', compact('ujian'));

        // Tampilkan PDF di browser
        return $pdf->stream('semua-laporan-' . $ujian->subject . '.pdf');
    }
}
