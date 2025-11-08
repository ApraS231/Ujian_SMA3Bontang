<!-- File: resources/views/admin/reports/index.blade.php (UPDATED) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rekap Laporan & Berita Acara') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Ujian</th>
                                    <th scope="col" class="px-6 py-3">Ruangan</th>
                                    <th scope="col" class="px-6 py-3">Pengawas</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sessions as $session)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <!-- PERBAIKAN: Cek apakah data ujian ada -->
                                        @if ($session->exam)
                                            {{ $session->exam->subject }}
                                        @else
                                            <span class="text-red-500 font-bold">[Data Ujian Hilang]</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $session->room->name ?? '[Data Ruangan Hilang]' }}</td>
                                    <td class="px-6 py-4">{{ $session->supervisor->name ?? '[Data Pengawas Hilang]' }}</td>
                                    <td class="px-6 py-4">
                                        @if($session->attendances->where('status', '!=', 'belum diisi')->count() > 0)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Selesai</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Belum Dimulai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.reports.show', $session) }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Lihat Laporan</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="px-6 py-4 text-center">Tidak ada data laporan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

