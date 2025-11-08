<!-- File: resources/views/admin/sessions/index.blade.php (UPDATED) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Sesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.sessions.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                            Buat Sesi Baru
                        </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Ujian</th>
                                    <th scope="col" class="px-6 py-3">Ruangan</th>
                                    <th scope="col" class="px-6 py-3">Pengawas</th>
                                    <th scope="col" class="px-6 py-3">Waktu Sesi</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sessions as $session)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $session->exam->subject }} <br> <span class="text-xs text-gray-500">{{ $session->exam->exam_date->format('d M Y') }}</span></td>
                                    <td class="px-6 py-4">{{ $session->room->name }}</td>
                                    <td class="px-6 py-4">{{ $session->supervisor->name }}</td>
                                    <td class="px-6 py-4">{{ $session->session_time }}</td>
                                    <td class="px-6 py-4 text-right flex justify-end items-center space-x-3">
                                        <a href="{{ route('admin.sessions.show', $session) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                        <!-- TOMBOL BARU UNTUK CETAK KARTU -->
                                        <form action="{{ route('admin.sessions.destroy', $session) }}" method="POST" onsubmit="return confirm('Yakin hapus sesi ini? Semua data absensi dan kartu ujian terkait akan hilang.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="px-6 py-4 text-center">Belum ada sesi ujian yang dibuat.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
