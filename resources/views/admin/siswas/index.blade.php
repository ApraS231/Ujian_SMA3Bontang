<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Siswa') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Form Import Siswa -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Import Siswa dari Excel</h2>
                <p>Unggah file Excel (.xlsx, .xls) dengan kolom: <strong>nama</strong>, <strong>nis</strong>, dan <strong>kelas</strong>.</p>
                <form method="post" action="{{ route('admin.siswas.import') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">File Excel</span>
                        </label>
                        <input type="file" name="file" id="file" class="file-input file-input-bordered w-full max-w-xs" required />
                        @error('file')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Siswa -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Daftar Siswa Terdaftar</h2>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                            <tr>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->class }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
