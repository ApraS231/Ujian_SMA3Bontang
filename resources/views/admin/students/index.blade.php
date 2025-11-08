<!-- File: resources/views/admin/students/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Form Import Siswa -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Import Siswa dari Excel</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Unggah file Excel (.xlsx, .xls) dengan kolom: <strong>nama</strong>, <strong>nis</strong>, dan <strong>kelas</strong>.
                    </p>
                    <form method="post" action="{{ route('admin.students.import') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="file" :value="__('File Excel')" />
                            <input id="file" name="file" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        <x-primary-button class="bg-green-600 hover:bg-green-700">{{ __('Import') }}</x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Tabel Daftar Siswa -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Daftar Siswa Terdaftar</h3>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">NIS</th>
                                <th scope="col" class="px-6 py-3">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $student->name }}</th>
                                <td class="px-6 py-4">{{ $student->nis }}</td>
                                <td class="px-6 py-4">{{ $student->class }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center">Tidak ada data siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>