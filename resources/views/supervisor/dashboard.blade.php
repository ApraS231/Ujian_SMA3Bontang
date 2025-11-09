<!-- File: resources/views/supervisor/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Dasbor Pengawas') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-lg font-medium">
                    Jadwal Mengawas Anda
                </h3>
                <p class="mt-1 text-sm text-base-content text-opacity-60">
                    Berikut adalah daftar sesi ujian yang ditugaskan kepada Anda.
                </p>
            </div>
        </div>

        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="space-y-4">
                    @forelse ($examSessions as $session)
                        <div class="p-4 border-l-4 border-primary bg-base-200 rounded-r-lg flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-primary">{{ $session->exam->subject }}</p>
                                <p class="text-sm text-base-content text-opacity-80">
                                    <span class="font-medium">Tanggal:</span> {{ $session->exam->exam_date->format('l, d F Y') }}
                                </p>
                                <p class="text-sm text-base-content text-opacity-80">
                                    <span class="font-medium">Ruang:</span> {{ $session->room->name }} | <span class="font-medium">Sesi:</span> {{ $session->session_time }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('supervisor.attendance.show', $session) }}" class="btn btn-primary">
                                    Buka Absensi
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-base-content text-opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2zm14-12H5.012" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium">Tidak ada jadwal</h3>
                            <p class="mt-1 text-sm text-base-content text-opacity-60">Saat ini tidak ada jadwal mengawas yang ditugaskan untuk Anda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
