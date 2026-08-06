<aside
    class="bg-white border-r border-gray-200 hidden lg:flex flex-col h-screen sticky top-0 left-0 transition-all duration-300 z-30 shadow-sm"
    x-data="{
        isMini: localStorage.getItem('sidebar-mini') === 'true',
        toggle() {
            this.isMini = !this.isMini;
            localStorage.setItem('sidebar-mini', this.isMini);
        },
        collapse() {
            this.isMini = true;
            localStorage.setItem('sidebar-mini', 'true');
        }
    }" :class="isMini ? 'w-20' : 'w-64'">

    <!-- Logo Section -->
    <div class="flex items-center h-16 border-b border-gray-200 bg-primary shrink-0 overflow-hidden transition-all duration-300 px-4"
        :class="isMini ? 'justify-center' : 'justify-between'">
        <h1 class="text-xl font-bold text-white flex items-center whitespace-nowrap overflow-hidden">
            <i class="fa-solid fa-book-open" :class="isMini ? '' : 'mr-3'"></i>
            <span x-show="!isMini" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                Balai Medan
            </span>
        </h1>

        <button @click="toggle()" class="text-white/80 hover:text-white transition-colors focus:outline-none"
            x-show="!isMini">
            <i class="fa-solid fa-angles-left"></i>
        </button>
    </div>

    <!-- Toggle Button for Mini Mode (centered) -->
    <div x-show="isMini" class="flex justify-center py-2 border-b border-gray-100">
        <button @click="toggle()"
            class="text-gray-400 hover:text-primary transition-colors focus:outline-none p-2 rounded-lg hover:bg-gray-50">
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto p-3 space-y-1 custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" @click="collapse()"
            class="sidebar-link flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}"
            title="Dashboard">
            <i class="fa-solid fa-gauge-high w-6 text-center text-lg"></i>
            <span class="ml-3 font-medium whitespace-nowrap" x-show="!isMini" x-transition.opacity>Dashboard</span>
        </a>

        <!-- Capaian -->
        <a href="{{ route('capaian') }}" @click="collapse()"
            class="sidebar-link flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('capaian') ? 'active bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-50' }}"
            title="Capaian">
            <i class="fa-solid fa-chart-line w-6 text-center text-lg"></i>
            <span class="ml-3 font-medium whitespace-nowrap" x-show="!isMini" x-transition.opacity>Capaian</span>
        </a>

        @if(auth()->user()->isAdmin())
            <div class="pt-2 pb-1" x-show="!isMini">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3">Management</span>
            </div>

            <!-- Anggaran Dropdown -->
            <div x-data="{ open: {{ request()->routeIs('anggaran.*') ? 'true' : 'false' }} }">
                <button @click="open = !open; if(isMini) isMini = false;"
                    class="w-full sidebar-link flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('anggaran.*') ? 'text-primary' : 'text-gray-600 hover:bg-gray-50' }}"
                    title="Anggaran">
                    <div class="flex items-center">
                        <i class="fa-solid fa-money-bill-wave w-6 text-center text-lg"></i>
                        <span class="ml-3 font-medium whitespace-nowrap" x-show="!isMini"
                            x-transition.opacity>Anggaran</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                        :class="open ? 'rotate-180' : ''" x-show="!isMini"></i>
                </button>

                <div x-show="open && !isMini" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    class="pl-9 pr-2 space-y-1 mt-1">

                    {{-- Monitoring --}}
                    <a href="{{ route('anggaran.index') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('anggaran.index') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        Monitoring
                    </a>

                    {{-- Update Realisasi --}}
                    <a href="{{ route('anggaran.realisasi') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('anggaran.realisasi') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        Update Realisasi
                    </a>

                    {{-- Laporan Transaksi --}}
                    <a href="{{ route('anggaran.laporan') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('anggaran.laporan') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        Laporan Transaksi
                    </a>
                </div>
            </div>

            <!-- Pegawai Menu -->
            <div x-data="{ openPegawai: {{ request()->routeIs('pegawai.*') ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="isMini ? (toggle(), openPegawai = true) : (openPegawai = !openPegawai)"
                    class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200
                                                {{ request()->routeIs('pegawai.*') ? 'bg-primary/5 text-primary' : 'text-gray-600 hover:bg-gray-50' }}" title="Pegawai">
                    <div class="flex items-center">
                        <i class="fa-solid fa-users w-6 text-center text-lg"></i>
                        <span class="ml-3 font-medium whitespace-nowrap" x-show="!isMini"
                            x-transition.opacity>Pegawai</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                        :class="openPegawai ? 'rotate-180' : ''" x-show="!isMini"></i>
                </button>

                <!-- Submenu -->
                <div x-show="openPegawai && !isMini" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-9 space-y-1">
                    <a href="{{ route('pegawai.index') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('pegawai.index') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Data Pegawai
                    </a>
                    <a href="{{ route('pegawai.create') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('pegawai.create') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Tambah Pegawai
                    </a>
                    <a href="{{ route('pegawai.chart') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('pegawai.chart') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Grafik Pegawai
                    </a>
                </div>
            </div>

            <!-- Kerja Sama Menu (Mini mode fixed) -->
            <div x-data="{ openKerja: {{ request()->routeIs('kerjasama.*') || request()->routeIs('purchases.*') ? 'true' : 'false' }} }"
                class="space-y-1">
                <button @click="isMini ? (toggle(), openKerja = true) : (openKerja = !openKerja)"
                    class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200
                                                {{ request()->routeIs('kerjasama.*') || request()->routeIs('purchases.*') ? 'bg-primary/5 text-primary' : 'text-gray-600 hover:bg-gray-50' }}"
                    title="Kerja Sama">
                    <div class="flex items-center">
                        <i class="fa-solid fa-handshake w-6 text-center text-lg"></i>
                        <span class="ml-3 font-medium whitespace-nowrap" x-show="!isMini" x-transition.opacity>Kerja
                            Sama</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                        :class="openKerja ? 'rotate-180' : ''" x-show="!isMini"></i>
                </button>

                <div x-show="openKerja && !isMini" x-transition class="ml-9 space-y-1">
                    <a href="{{ route('kerjasama.index') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('kerjasama.index') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Data Kerja Sama
                    </a>
                    <a href="{{ route('kerjasama.create') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('kerjasama.create') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Tambah Kerja Sama
                    </a>
                    <a href="{{ route('kerjasama.laporan') }}" @click="collapse()"
                        class="block px-3 py-2 rounded-md text-sm {{ request()->routeIs('kerjasama.laporan') ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary hover:bg-gray-50' }}">
                        Laporan Kerja Sama
                    </a>
                </div>
            </div>
        @endif

    </nav>
</aside>

<!-- Mobile Sidebar remains full drawer for better UX -->
<div id="mobile-sidebar" class="lg:hidden fixed inset-0 z-50 bg-black/50 hidden">
    <aside
        class="w-64 bg-white h-full transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col"
        @click.stop>
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 bg-primary shrink-0">
            <h1 class="text-xl font-bold text-white">
                <i class="fa-solid fa-book-open mr-2"></i>Balai Medan APP
            </h1>
            <button id="close-sidebar-btn" class="text-white hover:text-gray-200 transition-colors duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 space-y-2 custom-scrollbar">
            <a href="{{ route('dashboard') }}"
                class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high w-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <a href="{{ route('capaian') }}"
                class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('capaian') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line w-5"></i>
                <span class="ml-3">Capaian</span>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admins.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admins.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield w-5"></i>
                    <span class="ml-3">Admin</span>
                </a>

                <a href="{{ route('anggaran.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('anggaran.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-money-bill-wave w-5"></i>
                    <span class="ml-3">Anggaran</span>
                </a>

                <a href="{{ route('pegawai.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users w-5"></i>
                    <span class="ml-3">Pegawai</span>
                </a>

                <a href="{{ route('kerjasama.index') }}"
                    class="sidebar-link flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('kerjasama.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-handshake w-5"></i>
                    <span class="ml-3">Kerjasama</span>
                </a>
            @endif

        </nav>
    </aside>
</div>