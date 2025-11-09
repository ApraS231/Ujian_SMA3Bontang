<?php

/*
|--------------------------------------------------------------------------
| 1. Controller & Tampilan Panitia (Admin) - Lanjutan
|--------------------------------------------------------------------------
|
| Implementasi untuk Manajemen Siswa (SiswaController) dan
| kelas untuk proses import data dari Excel.
|
*/

// File: app/Http/Controllers/Admin/SiswaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Imports\SiswaImport; // Import class yang akan kita buat
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);
        return view('admin.siswas.index', compact('siswas'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             // Anda bisa mengembalikan error validasi ke view
             // Contoh: return back()->withFailures($failures);
             return back()->with('error', 'Gagal mengimpor data. Pastikan format file Excel sudah benar.');
        }

        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil diimpor.');
    }
}
