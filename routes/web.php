<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan digunakan
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\Admin\UjianController;
use App\Http\Controllers\Admin\SesiUjianController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboardController;
use App\Http\Controllers\Supervisor\AttendanceController;
use App\Http\Controllers\UjianWizardController;

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
    Route::post('siswas/import', [SiswaController::class, 'import'])->name('siswas.import');
    Route::resource('siswas', SiswaController::class);

    // Manajemen Ruangan (CRUD)
    Route::resource('ruangs', RuangController::class);

    // Manajemen Ujian (CRUD)
    Route::resource('ujians', UjianController::class);
    // BARU: Route untuk halaman pencetakan kartu per ujian
    Route::get('/ujians/{ujian}/print-all-cards', [UjianController::class, 'printAllCardsForUjian'])->name('ujians.print-all-cards');
    Route::get('/ujians/{ujian}/print-all-reports', [UjianController::class, 'printAllReportsForUjian'])->name('ujians.print-all-reports');

    // Manajemen Sesi Ujian (Alokasi & Kartu Ujian)

    Route::resource('sesiujians', SesiUjianController::class);


    // Manajemen maintence
    Route::get('/maintenance', [\App\Http\Controllers\Admin\MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::post('/maintenance/clean-sessions', [\App\Http\Controllers\Admin\MaintenanceController::class, 'cleanOrphanSessions'])->name('maintenance.clean');

    
});

Route::middleware(['auth', 'role:panitia'])->prefix('admin')->name('wizard.')->group(function () {
    Route::get('wizard/step1', [UjianWizardController::class, 'showStep1'])->name('step1');
    Route::post('wizard/step1', [UjianWizardController::class, 'storeStep1'])->name('step1.store');
    Route::get('wizard/step2/{ujian}', [UjianWizardController::class, 'showStep2'])->name('step2');
    Route::post('wizard/step2/{ujian}', [UjianWizardController::class, 'storeStep2'])->name('step2.store');
    Route::get('wizard/step3/{ujian}', [UjianWizardController::class, 'showStep3'])->name('step3');
    Route::post('wizard/step3/{ujian}', [UjianWizardController::class, 'storeStep3'])->name('step3.store');
});


// =====================================================================
// GRUP ROUTE UNTUK PENGAWAS (SUPERVISOR)
// =====================================================================
// Semua route di dalam grup ini hanya bisa diakses oleh pengguna
// yang sudah login DAN memiliki peran 'pengawas'.
Route::middleware(['auth', 'role:pengawas'])->prefix('supervisor')->name('supervisor.')->group(function () {

    // Dashboard Pengawas (menampilkan jadwal yang harus diawasi)
   Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');

    // Halaman Absensi Digital
    Route::get('/attendance/{exam_session}', [AttendanceController::class, 'show'])->name('attendance.show');
    
    // Aksi untuk update status kehadiran (misal via AJAX/Fetch)
    Route::post('/attendance/update', [AttendanceController::class, 'update'])->name('attendance.update');

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

