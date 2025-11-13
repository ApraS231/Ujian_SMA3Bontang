<!-- File: resources/views/supervisor/attendance/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Absensi: {{ $examSession->subject->subject }}
        </h2>
        <p class="text-sm text-gray-600">
            Ruang: {{ $room->name }} | {{ \Carbon\Carbon::parse($examSession->exam_date)->format('d M Y') }} | {{ \Carbon\Carbon::parse($examSession->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($examSession->end_time)->format('H:i') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Daftar Siswa -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Daftar Peserta Ujian</h3>
                    <div class="mt-4 space-y-3">
                        @foreach ($kartuUjians as $kartu)
                        <div class="p-4 border rounded-lg flex justify-between items-center @if($kartu->status == 'hadir') bg-green-50 @elseif($kartu->status == 'tidak hadir') bg-red-50 @else bg-white @endif">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-gray-500 w-10">{{ $kartu->seat_number }}.</span>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $kartu->student->name }}</p>
                                    <p class="text-sm text-gray-600">NIS: {{ $kartu->student->nis }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <form action="{{ route('supervisor.attendance.update', $kartu->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="hadir">
                                    <button type="submit" class="px-3 py-1 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 disabled:opacity-50" @if($kartu->status == 'hadir') disabled @endif>Hadir</button>
                                </form>
                                <form action="{{ route('supervisor.attendance.update', $kartu->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="tidak hadir">
                                    <button type="submit" class="px-3 py-1 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 disabled:opacity-50" @if($kartu->status == 'tidak hadir') disabled @endif>Tidak Hadir</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Catatan Kejadian -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Catatan Kejadian</h3>
                    <div class="mt-4 space-y-2">
                        @forelse($eventNotes as $note)
                            <div class="p-3 bg-gray-100 rounded-lg">
                                <p class="text-sm text-gray-800">{{ $note->note }}</p>
                                <p class="text-xs text-right text-gray-500">{{ $note->created_at->format('H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada catatan.</p>
                        @endforelse
                    </div>
                    <form action="{{ route('supervisor.attendance.storeNote') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="exam_session_id" value="{{ $examSession->id }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div>
                            <label for="note" class="block text-sm font-medium text-gray-700">Tambah Catatan Baru</label>
                            <textarea id="note" name="note" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                        </div>
                        <div class="flex justify-end mt-4">
                             <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">Simpan Catatan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
