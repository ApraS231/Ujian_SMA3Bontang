<!-- File: resources/views/admin/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dasbor Panitia') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Selamat Datang, {{ Auth::user()->name }}!
            </h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ini adalah pusat kendali untuk sistem otomatisasi ujian.
            </p>
        </div>

        <!-- Grid untuk Kartu Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kartu Total Pengawas -->
            <div class="bg-gradient-to-br from-green-500 to-teal-500 text-white overflow-hidden shadow-lg rounded-lg transform hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-white bg-opacity-30">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372m-1.025-.372c.309-.126.6-.268.868-.428m-2.43-4.586a9.38 9.38 0 01-2.43 4.586m0 0a9.382 9.382 0 01-5.25 0M12 4.5a3 3 0 013 3m-3-3a3 3 0 00-3 3m-3.75 9.128a9.383 9.383 0 01-2.625-.372m.372-3.496a9.383 9.383 0 012.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m5.25 3.496a9.383 9.383 0 01-2.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m2.25 0a9.383 9.383 0 012.25 0m0 0a9.383 9.383 0 002.25 0m2.25 0a9.383 9.383 0 012.25 0m-2.25 0a9.382 9.382 0 01-2.25 0m5.25 0a9.383 9.383 0 012.25 0m2.25 0a9.383 9.383 0 002.25 0m-2.25 0a9.383 9.383 0 01-2.25 0m-5.25 0a9.383 9.383 0 01-2.25 0" /></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium uppercase tracking-wider">Total Pengawas</p>
                            <p class="text-3xl font-bold">{{ $total_pengawas ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kartu Total Siswa -->
            <div class="bg-gradient-to-br from-green-500 to-cyan-500 text-white overflow-hidden shadow-lg rounded-lg transform hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-white bg-opacity-30">
                             <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium uppercase tracking-wider">Total Siswa</p>
                            <p class="text-3xl font-bold">{{ $total_siswa ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kartu Total Ujian -->
            <div class="bg-gradient-to-br from-green-500 to-emerald-500 text-white overflow-hidden shadow-lg rounded-lg transform hover:scale-105 transition-transform duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-white bg-opacity-30">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium uppercase tracking-wider">Total Ujian</p>
                            <p class="text-3xl font-bold">{{ $total_ujian ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>