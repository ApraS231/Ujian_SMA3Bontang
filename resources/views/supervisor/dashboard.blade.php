<!-- File: resources/views/supervisor/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dasbor Pengawas') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
         <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Jadwal Mengawas Anda
            </h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Berikut adalah daftar sesi ujian yang ditugaskan kepada Anda.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="space-y-4">
                    @forelse ($examSessions as $session)
                        <div class="p-4 border-l-4 border-green-500 bg-gray-50 dark:bg-gray-700/50 rounded-r-lg flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-green-700 dark:text-green-400">{{ $session->exam->subject }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Tanggal:</span> {{ $session->exam->exam_date->format('l, d F Y') }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Ruang:</span> {{ $session->room->name }} | <span class="font-medium">Sesi:</span> {{ $session->session_time }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('supervisor.attendance.show', $session) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Buka Absensi
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2zm14-12H5.012" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-200">Tidak ada jadwal</h3>
                            <p class="mt-1 text-sm text-gray-500">Saat ini tidak ada jadwal mengawas yang ditugaskan untuk Anda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
