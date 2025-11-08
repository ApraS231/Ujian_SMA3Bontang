<?php
namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */ // <-- TAMBAHKAN BARIS INI
        $user = Auth::user();

        // Baris ini sekarang tidak akan error di IDE Anda karena
        // IDE sudah tahu bahwa $user adalah instance dari App\Models\User
        // yang memiliki metode supervisedSessions().
        $examSessions = $user->supervisedSessions()->with(['exam', 'room'])->latest()->get();

        return view('supervisor.dashboard', compact('examSessions'));
    }
}
