<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Ruangan') }}
        </h2>
    </x-slot>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.ruangs.create') }}" class="btn btn-primary">
                    Tambah Ruangan
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ruangs as $ruang)
                        <tr>
                            <td>{{ $ruang->name }}</td>
                            <td>{{ $ruang->capacity }} orang</td>
                            <td class="flex justify-end space-x-2">
                                <a href="{{ route('admin.ruangs.edit', $ruang) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.ruangs.destroy', $ruang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data ruangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
