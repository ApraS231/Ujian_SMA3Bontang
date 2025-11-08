<!-- File: resources/views/admin/sessions/create.blade.php (UPDATED) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Sesi Ujian Baru') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.sessions.store') }}">
                        @csrf
                        <!-- Pilih Ujian -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="exam_id" :value="__('Ujian')" />
                                <select id="exam_id" name="exam_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                                    @foreach($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->subject }} ({{ $exam->exam_date->format('d M Y') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- BARU: Pilih Kelas -->
                            <div>
                                <x-input-label for="class" :value="__('Kelas yang Akan Dijadwalkan')" />
                                <select id="class" name="class" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class }}">{{ $class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Pilih Ruangan -->
                        <div class="mt-4">
                            <x-input-label for="room_id" :value="__('Ruangan Ujian')" />
                            <select id="room_id" name="room_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }} (Kapasitas: {{ $room->capacity }} orang)</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Pengawas -->
                        <div class="mt-4">
                            <x-input-label for="supervisor_id" :value="__('Pengawas')" />
                            <select id="supervisor_id" name="supervisor_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                                <option value="">-- Pilih Pengawas --</option>
                                @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- BARU: Input Waktu Sesi -->
                        <div class="mt-4">
                            <x-input-label for="session_times" :value="__('Waktu Sesi')" />
                            <x-text-input id="session_times" class="block mt-1 w-full" type="text" name="session_times" :value="old('session_times')" required />
                            <p class="mt-1 text-sm text-black-500 dark:text-black-400">
                                Contoh: 08:00 - 10:00. Jika butuh lebih dari 1 sesi, pisahkan dengan koma. Contoh: 08:00 - 10:00, 10:30 - 12:30
                            </p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700">
                                {{ __('Buat Sesi Otomatis') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
