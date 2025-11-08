<?php

/*
|--------------------------------------------------------------------------
| 1. Controller & Tampilan Panitia (Admin)
|--------------------------------------------------------------------------
|
| Berikut adalah implementasi untuk dasbor dan manajemen pengguna
| oleh panitia.
|
*/

// File: app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Exam;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk statistik di dasbor
        $total_pengawas = User::where('role', 'pengawas')->count();
        $total_siswa = Student::count();
        $total_ujian = Exam::count();

        return view('admin.dashboard', compact('total_pengawas', 'total_siswa', 'total_ujian'));
    }
}