<!-- File: resources/views/admin/exams/index.blade.php (UPDATED) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Ujian & Pencetakan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.exams.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                            Tambah Ujian
                        </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Mata Pelajaran</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Ujian</th>
                                    <th scope="col" class="px-6 py-3">Status</th> <!-- Kolom Baru -->
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($exams as $exam)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $exam->subject }}</th>
                                    <td class="px-6 py-4">{{ $exam->exam_date->format('d F Y') }}</td>
                                    <td class="px-6 py-4">
                                        <!-- Logika Status Ujian -->
                                        @if (\Carbon\Carbon::parse($exam->exam_date)->isPast())
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Sudah Terlaksana</span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Belum Terlaksana</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex items-center space-x-3">
                                        <!-- Tombol Cetak Kartu -->
                                        <a href="{{ route('admin.exams.print-all-cards', $exam) }}" target="_blank" class="font-medium text-green-600 dark:text-green-500 hover:underline">Cetak Kartu</a>
                                        <!-- Tombol Cetak Laporan -->
                                        <a href="{{ route('admin.exams.print-all-reports', $exam) }}" target="_blank" class="font-medium text-purple-600 dark:text-purple-500 hover:underline">Cetak Laporan</a>
                                        <a href="{{ route('admin.exams.edit', $exam) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST" onsubmit="return confirm('Yakin hapus ujian ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center">Tidak ada data ujian.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
