<!-- File: resources/views/supervisor/attendance/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Absensi: {{ $exam->subject }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Ruang: {{ $room->name }} | {{ $exam->exam_date->format('d M Y') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Daftar Siswa -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Daftar Peserta Ujian</h3>
                    <div class="mt-4 space-y-3">
                        @foreach ($kartuUjians as $kartu)
                        <div class="p-4 border rounded-lg flex justify-between items-center @if($kartu->status == 'hadir') bg-green-50 dark:bg-green-900/50 border-green-200 dark:border-green-800 @elseif($kartu->status == 'tidak hadir') bg-red-50 dark:bg-red-900/50 border-red-200 dark:border-red-800 @else border-gray-200 dark:border-gray-700 @endif">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-gray-500 dark:text-gray-400 w-10">{{ $kartu->seat_number }}.</span>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $kartu->student->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">NIS: {{ $kartu->student->nis }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <!-- Form untuk update status Hadir -->
                                <form action="{{ route('supervisor.attendance.update', $kartu->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="hadir">
                                    <button type="submit" class="btn btn-sm btn-success" @if($kartu->status == 'hadir') disabled @endif>Hadir</button>
                                </form>
                                <!-- Form untuk update status Tidak Hadir -->
                                <form action="{{ route('supervisor.attendance.update', $kartu->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="tidak hadir">
                                    <button type="submit" class="btn btn-sm btn-error" @if($kartu->status == 'tidak hadir') disabled @endif>Tidak Hadir</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Catatan Kejadian -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Catatan Kejadian</h3>
                    <!-- Daftar catatan yang sudah ada -->
                    <div class="mt-4 space-y-2">
                        @forelse($eventNotes as $note)
                            <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <p class="text-sm text-gray-800 dark:text-gray-300">{{ $note->note }}</p>
                                <p class="text-xs text-right text-gray-500 dark:text-gray-400">{{ $note->created_at->format('H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada catatan.</p>
                        @endforelse
                    </div>
                    <!-- Form untuk menambah catatan baru -->
                    <form action="{{ route('supervisor.attendance.storeNote') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div>
                            <x-input-label for="note" :value="__('Tambah Catatan Baru')" />
                            <textarea id="note" name="note" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" required></textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-primary-button class="bg-green-600 hover:bg-green-700">{{ __('Simpan Catatan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
