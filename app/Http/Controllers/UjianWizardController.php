<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Ruang;
use App\Models\Siswa;
use App\Models\SesiUjian;
use App\Models\KartuUjian;
use App\Models\User;

class UjianWizardController extends Controller
{
    // Step 1: Show the form to create a new Ujian
    public function showStep1()
    {
        return view('wizard.step1');
    }

    // Step 1: Store the new Ujian and redirect to step 2
    public function storeStep1(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $ujian = Ujian::create($request->all());

        return redirect()->route('wizard.step2', ['ujian' => $ujian]);
    }

    // Step 2: Show the form to select Ruang for the Ujian
    public function showStep2(Ujian $ujian)
    {
        $ruangs = Ruang::all();
        $supervisors = User::where('role', 'pengawas')->get();
        return view('wizard.step2', compact('ujian', 'ruangs', 'supervisors'));
    }

    // Step 2: Store the selected Ruangs and redirect to step 3
    public function storeStep2(Request $request, Ujian $ujian)
    {
        $request->validate([
            'ruangs' => 'required|array',
            'ruangs.*' => 'exists:ruangs,id',
            'supervisor_id' => 'required|exists:users,id',
        ]);

        // Create a SesiUjian for each selected Ruang
        foreach ($request->ruangs as $ruang_id) {
            SesiUjian::create([
                'ujian_id' => $ujian->id,
                'ruang_id' => $ruang_id,
                'supervisor_id' => $request->supervisor_id,
            ]);
        }

        return redirect()->route('wizard.step3', ['ujian' => $ujian]);
    }

    // Step 3: Show the form to assign Siswa to Ruangs
    public function showStep3(Request $request, Ujian $ujian)
    {
        $sesiUjians = $ujian->sesiUjians()->with('ruang')->get();
        $classes = Siswa::select('class')->distinct()->pluck('class');
        $selectedClass = $request->input('class');
        $siswas = $selectedClass ? Siswa::where('class', $selectedClass)->get() : Siswa::all();

        return view('wizard.step3', compact('ujian', 'sesiUjians', 'siswas', 'classes', 'selectedClass'));
    }

    // Step 3: Store the assigned Siswas and create KartuUjian
    public function storeStep3(Request $request, Ujian $ujian)
    {
        $request->validate([
            'assignments' => 'required|array',
        ]);

        foreach ($request->assignments as $sesi_ujian_id => $assignment) {
            $table_numbers = explode(',', $assignment['table_numbers']);
            if (count($table_numbers) < count($assignment['siswas'])) {
                return back()->withErrors(['assignments.' . $sesi_ujian_id . '.table_numbers' => 'Jumlah nomor meja tidak sesuai dengan jumlah siswa yang dipilih.'])->withInput();
            }
            foreach ($assignment['siswas'] as $index => $siswa_id) {
                KartuUjian::create([
                    'sesi_ujian_id' => $sesi_ujian_id,
                    'siswa_id' => $siswa_id,
                    'table_number' => $table_numbers[$index],
                ]);
            }
        }

        return redirect()->route('admin.ujians.index')->with('success', 'Ujian berhasil dibuat!');
    }
}
