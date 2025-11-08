<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-t">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sistem Ujian') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- AOS Animation Library -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <!-- Header & Navigation -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5 flex items-center space-x-3">
                        <!-- UBAH BAGIAN INI -->
                        <img class="h-8 w-auto" src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah">
                        <span class="text-white font-semibold text-xl">{{ config('app.name', 'Sistem Ujian') }}</span>
                    </a>
                </div>
                <div class="flex lg:flex-1 lg:justify-end">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold leading-6 text-white">Dashboard <span aria-hidden="true">&rarr;</span></a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white">Login <span aria-hidden="true">&rarr;</span></a>
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main>
            <!-- 1. Hero Section -->
            <div class="relative isolate overflow-hidden">
                <!-- Background Gradient & Image -->
                <div class="absolute inset-0 -z-10 h-full w-full bg-gradient-to-br from-green-600 to-teal-800"></div>
                <div class="absolute inset-0 -z-10 h-full w-full bg-cover bg-center opacity-10" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');"></div>

                <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                    <div class="text-center" data-aos="fade-up">
                        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Sistem Otomatisasi Ujian SMAN 3 Bontang</h1>
                        <p class="mt-6 text-lg leading-8 text-green-100">Manajemen Ujian yang Efisien, Akurat, dan Modern.</p>
                        <p class="mt-4 text-base leading-7 text-gray-300 max-w-xl mx-auto">
                            Selamat datang di pusat kendali ujian. Sistem ini dirancang untuk mempermudah panitia dan pengawas dalam mengelola seluruh proses administrasi ujian secara digital.
                        </p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <a href="{{ route('login') }}" class="rounded-md bg-white px-5 py-3 text-sm font-semibold text-green-700 shadow-sm hover:bg-green-50 focus:visible:outline focus:visible:outline-2 focus:visible:outline-offset-2 focus:visible:outline-white transition-transform transform hover:scale-105">
                                Login ke Sistem
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Fitur Unggulan -->
            <div class="bg-white dark:bg-gray-800 py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:text-center" data-aos="fade-up">
                        <h2 class="text-base font-semibold leading-7 text-green-600 dark:text-green-400">Fitur Unggulan Kami</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Semua yang Anda Butuhkan untuk Administrasi Ujian</p>
                    </div>
                    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                            <!-- Kartu 1 -->
                            <div class="relative pl-16" data-aos="fade-up" data-aos-delay="100">
                                <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-green-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18M3 7.5h18M3 12h18m-4.5 9v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" /></svg>
                                    </div>
                                    Manajemen Terpusat
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Kelola data siswa, jadwal ujian, ruangan, dan akun pengawas dengan mudah melalui satu dasbor terintegrasi.</dd>
                            </div>
                            <!-- Kartu 2 -->
                            <div class="relative pl-16" data-aos="fade-up" data-aos-delay="200">
                                <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-green-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    Otomatisasi Penuh
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Generate kartu peserta dan berita acara secara otomatis dalam hitungan detik. Siap cetak kapan saja.</dd>
                            </div>
                            <!-- Kartu 3 -->
                            <div class="relative pl-16" data-aos="fade-up" data-aos-delay="300">
                                <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-green-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                                    </div>
                                    Absensi Digital Real-time
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Lakukan absensi peserta ujian langsung dari perangkat Anda. Data kehadiran langsung tersimpan dan terekapitulasi.</dd>
                            </div>
                            <!-- Kartu 4 -->
                            <div class="relative pl-16" data-aos="fade-up" data-aos-delay="400">
                                <dt class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-green-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm-1.5 6.144L6.75 12l-1.5-1.5" /></svg>
                                    </div>
                                    Keamanan & Akurasi Data
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Dengan sistem berbasis peran dan validasi data, kami memastikan keamanan dan akurasi data administrasi ujian.</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- 3. Alur Kerja Sistem -->
            <div class="bg-gray-100 dark:bg-gray-900 py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:text-center" data-aos="fade-up">
                        <h2 class="text-base font-semibold leading-7 text-green-600 dark:text-green-400">Alur Kerja</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Tiga Langkah Mudah Pelaksanaan Ujian</p>
                    </div>
                    <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-center lg:max-w-none lg:grid-cols-3">
                        <!-- Langkah 1 -->
                        <div class="flex flex-col items-center" data-aos="fade-up" data-aos-delay="100">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-white font-bold text-xl">1</div>
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold leading-8 text-gray-900 dark:text-white">Input Data</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Panitia mengunggah data siswa, membuat jadwal ujian, dan mengatur sesi.</p>
                            </div>
                        </div>
                        <!-- Langkah 2 -->
                        <div class="flex flex-col items-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-white font-bold text-xl">2</div>
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold leading-8 text-gray-900 dark:text-white">Pelaksanaan</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Panitia mencetak kartu ujian. Pengawas melakukan absensi digital di ruang ujian.</p>
                            </div>
                        </div>
                        <!-- Langkah 3 -->
                        <div class="flex flex-col items-center" data-aos="fade-up" data-aos-delay="300">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-600 text-white font-bold text-xl">3</div>
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold leading-8 text-gray-900 dark:text-white">Pelaporan</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600 dark:text-gray-300">Sistem secara otomatis membuat berita acara berdasarkan data absensi yang siap diunduh.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- 4. Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-xs leading-5 text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} Panitia Ujian SMAN 3 Bontang. Seluruh hak cipta dilindungi.
                    </p>
                </div>
            </div>
        </footer>

        <!-- AOS Init -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                once: true,
            });
        </script>
    </body>
</html>
