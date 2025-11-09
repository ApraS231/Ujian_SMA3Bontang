<?php
// =====================================================================
// BARU: Controller untuk Manajemen Ruangan (RuangController)
// =====================================================================
// File: app/Http/Controllers/Admin/RuangController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::latest()->paginate(10);
        return view('admin.ruangs.index', compact('ruangs'));
    }

    public function create()
    {
        return view('admin.ruangs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ruangs',
            'capacity' => 'required|integer|min:1',
        ]);

        Ruang::create($request->all());

        return redirect()->route('admin.ruangs.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruang $ruang)
    {
        return view('admin.ruangs.edit', compact('ruang'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ruangs,name,' . $ruang->id,
            'capacity' => 'required|integer|min:1',
        ]);

        $ruang->update($request->all());

        return redirect()->route('admin.ruangs.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        // Tambahkan validasi jika ruangan sedang dipakai sesi ujian
        if ($ruang->sesiUjians()->exists()) {
            return back()->with('error', 'Ruangan tidak dapat dihapus karena sedang digunakan dalam sesi ujian.');
        }
        $ruang->delete();
        return redirect()->route('admin.ruangs.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
