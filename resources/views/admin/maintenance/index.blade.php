<!-- File: resources/views/admin/maintenance/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perawatan Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Pembersihan Data Sesi Ujian Rusak</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Fitur ini akan mencari dan menghapus data sesi ujian yang terhubung dengan data ujian utama yang sudah tidak ada (data rusak/yatim). Gunakan fitur ini jika Anda mengalami error saat mencetak kartu ujian.
                    </p>

                    <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/50 border-l-4 border-yellow-400 dark:border-yellow-500 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400 dark:text-yellow-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700 dark:text-yellow-200">
                                    Ditemukan <span class="font-bold">{{ $orphanCount }}</span> sesi ujian yang rusak.
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($orphanCount > 0)
                    <form action="{{ route('admin.maintenance.clean') }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data sesi yang rusak? Tindakan ini tidak dapat diurungkan.');">
                        @csrf
                        <x-primary-button class="bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800">
                            Hapus Data Sesi Rusak Sekarang
                        </x-primary-button>
                    </form>
                    @else
                    <p class="mt-4 text-sm text-green-600 dark:text-green-400">Database Anda bersih. Tidak ada tindakan yang diperlukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

