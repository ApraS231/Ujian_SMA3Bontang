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
                    <!-- Add other admin links here with the same structure -->
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
