<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Ujian & Pencetakan') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.ujians.create') }}" class="btn btn-primary">
                    Tambah Ujian
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <th>Tanggal Ujian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ujians as $ujian)
                        <tr>
                            <td>{{ $ujian->subject }}</td>
                            <td>{{ $ujian->exam_date->format('d F Y') }}</td>
                            <td>
                                @if (\Carbon\Carbon::parse($ujian->exam_date)->isPast())
                                    <div class="badge badge-neutral">Sudah Terlaksana</div>
                                @else
                                    <div class="badge badge-success">Belum Terlaksana</div>
                                @endif
                            </td>
                            <td class="flex items-center space-x-3">
                                <a href="{{ route('admin.ujians.print-all-cards', $ujian) }}" target="_blank" class="btn btn-sm btn-info">Cetak Kartu</a>
                                <a href="{{ route('admin.ujians.print-all-reports', $ujian) }}" target="_blank" class="btn btn-sm btn-warning">Cetak Laporan</a>
                                <a href="{{ route('admin.ujians.edit', $ujian) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.ujians.destroy', $ujian) }}" method="POST" onsubmit="return confirm('Yakin hapus ujian ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Tidak ada data ujian.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
