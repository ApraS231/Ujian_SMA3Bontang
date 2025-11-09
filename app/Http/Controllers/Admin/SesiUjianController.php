<?php

/*
|--------------------------------------------------------------------------
| 1. Perbarui SesiUjianController
|--------------------------------------------------------------------------
|
| Controller ini dirombak untuk menangani logika pengelompokan siswa
| per kelas dan pembagian sesi secara otomatis.
|
*/

// File: app/Http/Controllers/Admin/SesiUjianController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SesiUjian;
use App\Models\Ujian;
use App\Models\Ruang;
use App\Models\User;
use App\Models\Siswa;
use App\Models\KartuUjian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SesiUjianController extends Controller
{
    public function index()
    {
        $sesiUjians = SesiUjian::with(['ujian', 'ruang', 'supervisor'])->latest()->paginate(10);
        return view('admin.sesiujians.index', compact('sesiUjians'));
    }

    public function create()
    {
        // Ambil data yang dibutuhkan untuk form
        $ujians = Ujian::orderBy('exam_date', 'desc')->get();
        $ruangs = Ruang::orderBy('name')->get();
        $supervisors = User::where('role', 'pengawas')->orderBy('name')->get();
        
        // BARU: Ambil daftar kelas unik dari tabel siswa
        $classes = Siswa::select('class')->distinct()->orderBy('class')->pluck('class');

        return view('admin.sesiujians.create', compact('ujians', 'ruangs', 'supervisors', 'classes'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'ujian_id' => 'required|exists:ujians,id',
            'class' => 'required|string', // Sekarang kita menerima nama kelas
            'ruang_id' => 'required|exists:ruangs,id',
            'supervisor_id' => 'required|exists:users,id',
            'session_times' => 'required|string', // Menerima satu atau lebih waktu sesi
        ]);

        // 2. Ambil data siswa dan ruangan
        $siswas = Siswa::where('class', $request->class)->orderBy('name')->get();
        $ruang = Ruang::findOrFail($request->ruang_id);

        if ($siswas->isEmpty()) {
            return back()->with('error', 'Tidak ada siswa yang ditemukan untuk kelas ' . $request->class)->withInput();
        }

        // 3. Proses waktu sesi
        $sessionTimes = array_map('trim', explode(',', $request->session_times));

        // 4. Bagi siswa ke dalam beberapa kelompok (chunk) berdasarkan kapasitas ruangan
        $studentChunks = $siswas->chunk($ruang->capacity);

        // 5. Validasi apakah jumlah sesi yang dibutuhkan melebihi waktu yang disediakan
        if ($studentChunks->count() > count($sessionTimes)) {
            return back()->with('error', 'Jumlah sesi yang dibutuhkan (' . $studentChunks->count() . ') melebihi jumlah waktu sesi yang disediakan (' . count($sessionTimes) . '). Silakan tambahkan waktu sesi.')->withInput();
        }

        $createdSessionsCount = 0;
        // 6. Loop untuk setiap kelompok siswa dan buat sesi
        foreach ($studentChunks as $index => $studentChunk) {
            // Buat Sesi Ujian baru
            $sesiUjian = SesiUjian::create([
                'ujian_id' => $request->ujian_id,
                'ruang_id' => $request->ruang_id,
                'supervisor_id' => $request->supervisor_id,
                'session_time' => $sessionTimes[$index], // Ambil waktu sesi sesuai urutan
            ]);

            // 7. Alokasikan siswa dari kelompok ini ke sesi yang baru dibuat
            $tableNumber = 1;
            foreach ($studentChunk as $siswa) {
                KartuUjian::create([
                    'sesi_ujian_id' => $sesiUjian->id,
                    'siswa_id' => $siswa->id,
                    'table_number' => $tableNumber++,
                ]);
            }
            $createdSessionsCount++;
        }

        return redirect()->route('admin.sesiujians.index')->with('success', $createdSessionsCount . ' sesi ujian berhasil dibuat untuk kelas ' . $request->class . '.');
    }

    // Method lainnya (show, destroy) tetap sama ...
    public function show(SesiUjian $sesiUjian)
    {
        $sesiUjian->load(['kartuUjians.siswa']);
        return view('admin.sesiujians.show', compact('sesiUjian'));
    }

    public function destroy(SesiUjian $sesiUjian)
    {
        $sesiUjian->kartuUjians()->delete();
        $sesiUjian->delete();
        return redirect()->route('admin.sesiujians.index')->with('success', 'Sesi ujian berhasil dihapus.');
    }
}
