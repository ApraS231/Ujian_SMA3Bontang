<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Room;
use App\Models\Student;
use App\Models\KartuUjian;

class KartuUjianController extends Controller
{
    // Step 1: Create Exam
    public function createStep1()
    {
        return view('admin.kartu-ujian.create-step-1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
        ]);

        $exam = Exam::create($request->all());

        return redirect()->route('admin.kartu-ujian.create-step-2', $exam);
    }

    // Step 2: Select Rooms
    public function createStep2(Exam $exam)
    {
        $rooms = Room::all();
        return view('admin.kartu-ujian.create-step-2', compact('exam', 'rooms'));
    }

    public function storeStep2(Request $request, Exam $exam)
    {
        $request->validate([
            'room_ids' => 'required|array|min:1',
            'room_ids.*' => 'exists:rooms,id',
        ]);

        $request->session()->put('selected_rooms', $request->room_ids);

        return redirect()->route('admin.kartu-ujian.create-step-3', $exam);
    }

    // Step 3: Assign Students
    public function createStep3(Exam $exam, Request $request)
    {
        $room_ids = $request->session()->get('selected_rooms');
        $rooms = Room::whereIn('id', $room_ids)->get();
        $students = Student::all(); // In a real app, you might want to paginate this
        $classes = Student::select('class')->distinct()->pluck('class');


        return view('admin.kartu-ujian.create-step-3', compact('exam', 'rooms', 'students', 'classes'));
    }

    public function storeStep3(Request $request, Exam $exam)
    {
        $request->validate([
            'rooms' => 'required|array',
            'rooms.*.class' => 'required|string',
            'rooms.*.seat_start' => 'required|integer|min:1',
        ]);

        $room_ids = $request->session()->get('selected_rooms');
        $rooms_data = Room::whereIn('id', $room_ids)->get()->keyBy('id');

        \DB::transaction(function () use ($request, $exam, $rooms_data) {
            foreach ($request->rooms as $roomId => $config) {
                $room = $rooms_data->get($roomId);
                if (!$room) continue;

                $students = Student::where('class', $config['class'])->get();
                $seat_number = (int)$config['seat_start'];

                foreach ($students as $student) {
                    if ($seat_number > $room->capacity) {
                        // Optional: Add a warning or error message
                        break;
                    }

                    KartuUjian::create([
                        'exam_id' => $exam->id,
                        'room_id' => $roomId,
                        'student_id' => $student->id,
                        'seat_number' => $seat_number,
                    ]);

                    $seat_number++;
                }
            }
        });

        $request->session()->forget('selected_rooms');

        // Redirect to a summary or success page
        return redirect()->route('admin.dashboard')->with('success', 'Kartu ujian berhasil dibuat.');
    }
}
