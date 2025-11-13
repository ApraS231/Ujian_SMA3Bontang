<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ExamSession;
use App\Models\Room;
use App\Models\Student;
use App\Models\KartuUjian;

class KartuUjianController extends Controller
{
    // Step 1: Create Exam Session
    public function createStep1()
    {
        $subjects = Subject::all();
        return view('admin.kartu-ujian.create-step-1', compact('subjects'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'exam_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $examSession = ExamSession::create($request->all());

        return redirect()->route('admin.kartu-ujian.create-step-2', $examSession);
    }

    // Step 2: Select Rooms
    public function createStep2(ExamSession $examSession)
    {
        $rooms = Room::all();
        return view('admin.kartu-ujian.create-step-2', compact('examSession', 'rooms'));
    }

    public function storeStep2(Request $request, ExamSession $examSession)
    {
        $request->validate([
            'room_ids' => 'required|array|min:1',
            'room_ids.*' => 'exists:rooms,id',
        ]);

        $request->session()->put('selected_rooms', $request->room_ids);

        return redirect()->route('admin.kartu-ujian.create-step-3', $examSession);
    }

    // Step 3: Assign Students
    public function createStep3(ExamSession $examSession, Request $request)
    {
        $room_ids = $request->session()->get('selected_rooms');
        if (!$room_ids) {
            return redirect()->route('admin.kartu-ujian.create-step-2', $examSession)->with('error', 'Silakan pilih ruangan terlebih dahulu.');
        }
        $rooms = Room::whereIn('id', $room_ids)->get();
        $classes = Student::select('class')->distinct()->pluck('class');

        return view('admin.kartu-ujian.create-step-3', compact('examSession', 'rooms', 'classes'));
    }

    public function storeStep3(Request $request, ExamSession $examSession)
    {
        $request->validate([
            'rooms' => 'required|array',
            'rooms.*.class' => 'required|string',
            'rooms.*.seat_start' => 'required|integer|min:1',
        ]);

        $room_ids = $request->session()->get('selected_rooms');
        $rooms_data = Room::whereIn('id', $room_ids)->get()->keyBy('id');

        \DB::transaction(function () use ($request, $examSession, $rooms_data) {
            foreach ($request->rooms as $roomId => $config) {
                $room = $rooms_data->get($roomId);
                if (!$room) continue;

                $students = Student::where('class', $config['class'])->get();
                $seat_number = (int)$config['seat_start'];

                foreach ($students as $student) {
                    if ($seat_number > $room->capacity) {
                        break;
                    }

                    KartuUjian::create([
                        'exam_session_id' => $examSession->id,
                        'room_id' => $roomId,
                        'student_id' => $student->id,
                        'seat_number' => $seat_number,
                    ]);

                    $seat_number++;
                }
            }
        });

        $request->session()->forget('selected_rooms');

        return redirect()->route('admin.dashboard')->with('success', 'Kartu ujian berhasil dibuat.');
    }
}
