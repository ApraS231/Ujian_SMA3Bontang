<!--
|--------------------------------------------------------------------------
| File Navigasi Sidebar (navigation.blade.php) - REBUILT with pure Tailwind CSS
|--------------------------------------------------------------------------
|
-->
<aside class="w-64 h-screen sticky top-0 bg-gray-900 text-gray-300 flex-shrink-0 flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-800 flex-shrink-0">
        <a href="{{ route('dashboard') }}">
            <img class="h-12 w-auto" src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah">
        </a>
    </div>

    <!-- Menu Utama -->
    <div class="flex-grow overflow-y-auto py-4">
        @if(Auth::user()->role === 'panitia')
            <nav class="px-4">
                <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Panitia</h3>
                <ul class="mt-2 space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.dashboard')) bg-gray-700 text-white @endif">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.users.*')) bg-gray-700 text-white @endif">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372m-1.025-.372c.309-.126.6-.268.868-.428m-2.43-4.586a9.38 9.38 0 01-2.43 4.586m0 0a9.382 9.382 0 01-5.25 0M12 4.5a3 3 0 013 3m-3-3a3 3 0 00-3 3m-3.75 9.128a9.383 9.383 0 01-2.625-.372m.372-3.496a9.383 9.383 0 012.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m5.25 3.496a9.383 9.383 0 01-2.25 0m-2.25 0a9.383 9.383 0 00-2.25 0m2.25 0a9.383 9.383 0 012.25 0m0 0a9.383 9.383 0 002.25 0m2.25 0a9.383 9.383 0 012.25 0m-2.25 0a9.382 9.382 0 01-2.25 0m5.25 0a9.383 9.383 0 012.25 0m2.25 0a9.383 9.383 0 002.25 0m-2.25 0a9.383 9.383 0 01-2.25 0m-5.25 0a9.383 9.383 0 01-2.25 0" /></svg>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.students.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.students.*')) bg-gray-700 text-white @endif">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rooms.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.rooms.*')) bg-gray-700 text-white @endif">
                           <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18M3 7.5h18M3 12h18m-4.5 9v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" /></svg>
                            <span>Ruangan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subjects.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.subjects.*')) bg-gray-700 text-white @endif">
                           <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                            <span>Mata Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kartu-ujian.create-step-1') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.kartu-ujian.*')) bg-gray-700 text-white @endif">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                            <span>Buat Kartu Ujian</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cetak-kartu.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.cetak-kartu.*')) bg-gray-700 text-white @endif">
                            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" /></svg>
                            <span>Cetak Kartu</span>
                        </a>
                    </li>
                </ul>
            </nav>
        @elseif(Auth::user()->role === 'pengawas')
            <!-- Supervisor Menu -->
        @endif
    </div>

    <!-- Profil & Logout -->
    <div class="mt-auto border-t border-gray-800 p-4">
        <div class="flex items-center">
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="User Avatar">
            <div class="ml-3">
                <div class="font-semibold text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="w-full text-left flex items-center px-4 py-2 rounded-md text-sm hover:bg-red-700/50">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" /></svg>
                <span>Log Out</span>
            </a>
        </form>
    </div>
</aside>
