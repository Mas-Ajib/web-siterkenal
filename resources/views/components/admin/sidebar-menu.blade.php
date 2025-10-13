<!-- resources/views/components/admin/sidebar-menu.blade.php -->
<div class="space-y-1 px-2">
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
        <span class="flex-1">Dashboard</span>
    </a>

    <!-- Layanan Informasi PPID -->
    <a href="{{ route('admin.layanan.ppid.index') }}"
        class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg {{ request()->routeIs('admin.layanan.ppid.*') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-info-circle mr-3 w-5 text-center"></i>
        <span class="flex-1">Layanan Informasi PPID</span>
    </a>

    <!-- Layanan Rehabilitasi -->
    <a href="{{ route('admin.layanan.rehabilitasi.index') }}"
        class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg {{ request()->routeIs('admin.layanan.rehabilitasi.*') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-heartbeat mr-3 w-5 text-center"></i>
        <span class="flex-1">Layanan Rehabilitasi</span>
    </a>

    <!-- Layanan Permohonan Kegiatan -->
    <div x-data="{ open: {{ request()->routeIs('admin.layanan.kegiatan.*') ? 'true' : 'false' }} }" class="relative">
        <button @click="open = !open"
            class="flex items-center justify-between w-full px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3 w-5 text-center"></i>
                <span class="flex-1 text-left">Layanan Permohonan Kegiatan</span>
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
        </button>

        <div x-show="open" x-collapse class="bg-blue-900 rounded-lg mt-1 ml-2">
            <a href="{{ route('admin.layanan.kegiatan.sosialisasi') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.kegiatan.sosialisasi') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Kegiatan Sosialisasi
            </a>
            <a href="{{ route('admin.layanan.kegiatan.magang') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.kegiatan.magang') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Kegiatan Magang
            </a>
            <a href="{{ route('admin.layanan.kegiatan.tes-urine') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.kegiatan.tes-urine') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Kegiatan Tes Urine Mandiri
            </a>
            <a href="{{ route('admin.layanan.kegiatan.tat') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.kegiatan.tat') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Kegiatan TAT
            </a>
        </div>
    </div>

    <!-- Layanan Pengaduan Masyarakat -->
    <div x-data="{ open: {{ request()->routeIs('admin.layanan.pengaduan.*') ? 'true' : 'false' }} }" class="relative">
        <button @click="open = !open"
            class="flex items-center justify-between w-full px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 w-5 text-center"></i>
                <span class="flex-1 text-left">Layanan Pengaduan Masyarakat</span>
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
        </button>

        <div x-show="open" x-collapse class="bg-blue-900 rounded-lg mt-1 ml-2">
            <a href="{{ route('admin.layanan.pengaduan.gratifikasi') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.pengaduan.gratifikasi') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Pelaporan Gratifikasi
            </a>
            <a href="{{ route('admin.layanan.pengaduan.whistleblowing') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.pengaduan.whistleblowing') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Whistle Blowing System
            </a>
            <a href="{{ route('admin.layanan.pengaduan.narkoba') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.pengaduan.narkoba') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Pelaporan Penyalahgunaan Narkoba
            </a>
            <a href="{{ route('admin.layanan.pengaduan.kritiksaran') }}"
                class="block px-4 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded {{ request()->routeIs('admin.layanan.pengaduan.kritiksaran') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-circle text-xs mr-2 w-3"></i>
                Kritik, Saran dan Pengaduan Layanan
            </a>
        </div>
    </div>

    <!-- Kelola Admin -->
    @auth('admin')
        @if (auth()->guard('admin')->user()->isSuperadmin())
            <div class="px-4 py-2 mt-4">
                <p class="text-xs font-semibold text-gray-50 uppercase tracking-wider">Administrator</p>
            </div>

            <a href="{{ route('admin.management.index') }}"
                class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 rounded-lg {{ request()->routeIs('admin.management*') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-users-cog mr-3 w-5 text-center"></i>
                <span class="flex-1">Kelola Admin</span>
            </a>
        @endif
    @endauth

    <!-- Logout -->
    <form method="POST" action="{{ route('admin.logout') }}" class="pt-4 mt-4 border-t border-blue-700">
        @csrf
        <button type="submit"
            class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 w-full text-left rounded-lg">
            <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
            <span class="flex-1">Logout</span>
        </button>
    </form>
</div>