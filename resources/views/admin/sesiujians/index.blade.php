<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Sesi') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.sesiujians.create') }}" class="btn btn-primary">
                    Buat Sesi Baru
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Ujian</th>
                            <th>Ruangan</th>
                            <th>Pengawas</th>
                            <th>Waktu Sesi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sesiUjians as $sesiUjian)
                        <tr>
                            <td>{{ $sesiUjian->ujian->subject }} <br> <span class="text-xs">{{ $sesiUjian->ujian->exam_date->format('d M Y') }}</span></td>
                            <td>{{ $sesiUjian->ruang->name }}</td>
                            <td>{{ $sesiUjian->supervisor->name }}</td>
                            <td>{{ $sesiUjian->session_time }}</td>
                            <td class="flex justify-end items-center space-x-3">
                                <a href="{{ route('admin.sesiujians.show', $sesiUjian) }}" class="btn btn-sm btn-info">Detail</a>
                                <form action="{{ route('admin.sesiujians.destroy', $sesiUjian) }}" method="POST" onsubmit="return confirm('Yakin hapus sesi ini? Semua data absensi dan kartu ujian terkait akan hilang.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Belum ada sesi ujian yang dibuat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
