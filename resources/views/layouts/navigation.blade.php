<!--
|--------------------------------------------------------------------------
| File Navigasi Sidebar (navigation.blade.php)
|--------------------------------------------------------------------------
|
-->

<aside class="w-64 h-screen sticky top-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex-shrink-0 flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-200 dark:border-gray-700 flex-shrink-0">
        <a href="{{ route('dashboard') }}">
            <img class="h-12 w-auto" src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah">
        </a>
    </div>

    <!-- Bagian Menu yang Bisa di-scroll -->
    <div class="flex-grow overflow-y-auto py-4">
        @if(Auth::user()->role === 'panitia')
            <!-- Menu Panitia -->
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Panitia</h3>
            <ul class="mt-2 text-gray-600 dark:text-gray-400">
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </li>
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                         <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372m-1.025-.372c.309-.126.6-.268.868-.428m-2.43-4.586a9.38 9.38 0 01-2.43 4.586m0 0a9.382 9.382 0 01-5.25 0M12 4.5a3 3 0 013 3m-3-3a3 3 0 00-3 3m-3.75 9.128a9.383 9.383 0 01-2.625-.372m.372-3.496a9.383 9.383 0 012.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m5.25 3.496a9.383 9.383 0 01-2.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m2.25 0a9.383 9.383 0 012.25 0m0 0a9.383 9.383 0 002.25 0m2.25 0a9.383 9.383 0 012.25 0m-2.25 0a9.382 9.382 0 01-2.25 0m5.25 0a9.383 9.383 0 012.25 0m2.25 0a9.383 9.383 0 002.25 0m-2.25 0a9.383 9.383 0 01-2.25 0m-5.25 0a9.383 9.383 0 01-2.25 0" /></svg>
                        {{ __('Pengguna') }}
                    </x-responsive-nav-link>
                </li>
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>
                        {{ __('Siswa') }}
                    </x-responsive-nav-link>
                </li>
                 <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.rooms.index')" :active="request()->routeIs('admin.rooms.*')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18M3 7.5h18M3 12h18m-4.5 9v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" /></svg>
                        {{ __('Ruangan') }}
                    </x-responsive-nav-link>
                </li>
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.exams.index')" :active="request()->routeIs('admin.exams.*')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        {{ __('Ujian') }}
                    </x-responsive-nav-link>
                </li>
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.sessions.index')" :active="request()->routeIs('admin.sessions.*')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-3.75 2.25M12 13.5l-4.179-2.25L12 9l4.179 2.25L12 13.5zm0 0v5.25c0 .621-.504 1.125-1.125 1.125H9.75" /></svg>
                        {{ __('Sesi Ujian') }}
                    </x-responsive-nav-link>
                </li>
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('admin.maintenance.index')" :active="request()->routeIs('admin.maintenance.*')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.472-2.472a3.375 3.375 0 00-4.773-4.773L6.75 11.25l-2.472-2.472a3.375 3.375 0 00-4.773 4.773l2.472 2.472" /></svg>
                        {{ __('Perawatan') }}
                    </x-responsive-nav-link>
                </li>
            </ul>
        @elseif(Auth::user()->role === 'pengawas')
            <!-- Menu Pengawas -->
            <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Pengawas</h3>
            <ul class="mt-2 text-gray-600 dark:text-gray-400">
                <li class="px-2 py-1">
                    <x-responsive-nav-link :href="route('supervisor.dashboard')" :active="request()->routeIs('supervisor.dashboard')">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" /></svg>
                        {{ __('Jadwal Saya') }}
                    </x-responsive-nav-link>
                </li>
            </ul>
        @endif
    </div>

    <!-- Bagian Bawah Sidebar (Profil & Tombol Tema) -->
    <div class="mt-auto">
        <!-- Profil Pengguna -->
        <div class="border-t border-gray-200 dark:border-gray-700">
             <div class="px-4 py-3">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</aside>
