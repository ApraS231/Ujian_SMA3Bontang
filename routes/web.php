<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan digunakan
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboardController;
use App\Http\Controllers\Supervisor\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendaftarkan semua route untuk aplikasi.
|
*/

// Halaman Awal (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Route bawaan Breeze untuk dasbor umum setelah login.
// Kita akan arahkan pengguna dari sini berdasarkan perannya.
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'panitia') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'pengawas') {
        return redirect()->route('supervisor.dashboard');
    }
    // Fallback jika ada peran lain
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


// =====================================================================
// GRUP ROUTE UNTUK PANITIA (ADMIN)
// =====================================================================
// Semua route di dalam grup ini hanya bisa diakses oleh pengguna
// yang sudah login DAN memiliki peran 'panitia'.
Route::middleware(['auth', 'role:panitia'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Panitia
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengguna (CRUD)
    Route::resource('users', UserController::class);

    // Manajemen Siswa (Import & CRUD)
    Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
    Route::resource('students', StudentController::class);

    // Manajemen Ruangan (CRUD)
    Route::resource('rooms', RoomController::class);

    // Manajemen Mata Pelajaran (CRUD)
    Route::resource('subjects', SubjectController::class)->except(['show']);

    // Wizard Pembuatan Kartu Ujian
    Route::get('kartu-ujian/create-step-1', [\App\Http\Controllers\Admin\KartuUjianController::class, 'createStep1'])->name('kartu-ujian.create-step-1');
    Route::post('kartu-ujian/store-step-1', [\App\Http\Controllers\Admin\KartuUjianController::class, 'storeStep1'])->name('kartu-ujian.store-step-1');
    Route::get('kartu-ujian/{examSession}/create-step-2', [\App\Http\Controllers\Admin\KartuUjianController::class, 'createStep2'])->name('kartu-ujian.create-step-2');
    Route::post('kartu-ujian/{examSession}/store-step-2', [\App\Http\Controllers\Admin\KartuUjianController::class, 'storeStep2'])->name('kartu-ujian.store-step-2');
    Route::get('kartu-ujian/{examSession}/create-step-3', [\App\Http\Controllers\Admin\KartuUjianController::class, 'createStep3'])->name('kartu-ujian.create-step-3');
    Route::post('kartu-ujian/{examSession}/store-step-3', [\App\Http\Controllers\Admin\KartuUjianController::class, 'storeStep3'])->name('kartu-ujian.store-step-3');

    // Cetak Kartu Ujian
    Route::get('cetak-kartu', [\App\Http\Controllers\Admin\CetakKartuController::class, 'index'])->name('cetak-kartu.index');
    Route::get('cetak-kartu/{examSession}', [\App\Http\Controllers\Admin\CetakKartuController::class, 'print'])->name('cetak-kartu.print');


    // Manajemen maintence
    Route::get('/maintenance', [\App\Http\Controllers\Admin\MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::post('/maintenance/clean-sessions', [\App\Http\Controllers\Admin\MaintenanceController::class, 'cleanOrphanSessions'])->name('maintenance.clean');

    
});


// =====================================================================
// GRUP ROUTE UNTUK PENGAWAS (SUPERVISOR)
// =====================================================================
// Semua route di dalam grup ini hanya bisa diakses oleh pengguna
// yang sudah login DAN memiliki peran 'pengawas'.
Route::middleware(['auth', 'role:pengawas'])->prefix('supervisor')->name('supervisor.')->group(function () {

    // Dashboard Pengawas (menampilkan jadwal yang harus diawasi)
   Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');

    // Halaman Absensi Digital per Ruangan
    Route::get('/attendance/{examSession}/{room}', [AttendanceController::class, 'show'])->name('attendance.show');
    
    // Aksi untuk update status kehadiran (misal via AJAX/Fetch)
    Route::post('/attendance/update/{kartuUjian}', [AttendanceController::class, 'update'])->name('attendance.update');

    // Aksi untuk menyimpan catatan kejadian
    Route::post('/attendance/notes', [AttendanceController::class, 'storeNote'])->name('attendance.storeNote');

});


// Route bawaan Breeze untuk manajemen profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memanggil file route autentikasi bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';

