<!-- File: resources/views/admin/dashboard.blade.php -->
<x-app-layout>
    <x-pattern />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dasbor Panitia') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-base-100 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-base-content">
                Selamat Datang, {{ Auth::user()->name }}!
            </h3>
            <p class="mt-1 text-sm text-base-content text-opacity-60">
                Ini adalah pusat kendali untuk sistem otomatisasi ujian.
            </p>
        </div>

        <!-- Grid untuk Kartu Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kartu Total Pengawas -->
            <div class="card bg-success text-success-content">
                <div class="card-body">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-success-content bg-opacity-20 rounded-lg">
                            <x-icon-users class="w-8 h-8" />
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium uppercase tracking-wider opacity-80">Total Pengawas</p>
                            <p class="text-3xl font-bold">{{ $total_pengawas ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kartu Total Siswa -->
            <div class="card bg-info text-info-content">
                <div class="card-body">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-info-content bg-opacity-20 rounded-lg">
                             <x-icon-user-group class="w-8 h-8" />
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium uppercase tracking-wider opacity-80">Total Siswa</p>
                            <p class="text-3xl font-bold">{{ $total_siswa ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kartu Total Ujian -->
            <div class="card bg-warning text-warning-content">
                <div class="card-body">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-warning-content bg-opacity-20 rounded-lg">
                            <x-icon-book-open class="w-8 h-8" />
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium uppercase tracking-wider opacity-80">Total Ujian</p>
                            <p class="text-3xl font-bold">{{ $total_ujian ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
