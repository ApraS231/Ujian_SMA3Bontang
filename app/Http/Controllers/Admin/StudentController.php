<?php

/*
|--------------------------------------------------------------------------
| 1. Controller & Tampilan Panitia (Admin) - Lanjutan
|--------------------------------------------------------------------------
|
| Implementasi untuk Manajemen Siswa (StudentController) dan
| kelas untuk proses import data dari Excel.
|
*/

// File: app/Http/Controllers/Admin/StudentController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Imports\StudentsImport; // Import class yang akan kita buat
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             // Anda bisa mengembalikan error validasi ke view
             // Contoh: return back()->withFailures($failures);
             return back()->with('error', 'Gagal mengimpor data. Pastikan format file Excel sudah benar.');
        }

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diimpor.');
    }
}
