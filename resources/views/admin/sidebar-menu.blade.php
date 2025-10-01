<!-- resources/views/components/admin/sidebar-menu.blade.php -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
<div class="space-y-1">
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}" 
       class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-tachometer-alt mr-3"></i>
        Dashboard
    </a>

    <!-- Layanan Informasi PPID -->
    <a href="{{ route('admin.layanan.ppid.index') }}" 
       class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.ppid.*') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-info-circle mr-3"></i>
        Layanan Informasi PPID
    </a>

    <!-- Layanan Rehabilitasi -->
    <a href="{{ route('admin.layanan.rehabilitasi.index') }}" 
       class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.rehabilitasi.*') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-heartbeat mr-3"></i>
        Layanan Rehabilitasi
    </a>

    <!-- Layanan Permohonan Kegiatan -->
    <div x-data="{ open: {{ request()->routeIs('admin.layanan.kegiatan.*') ? 'true' : 'false' }} }">
        <button @click="open = !open" 
                class="flex items-center justify-between w-full px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-3"></i>
                Layanan Permohonan Kegiatan
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': open}"></i>
        </button>
        
        <div x-show="open" class="bg-blue-900">
            <a href="{{ route('admin.layanan.kegiatan.sosialisasi') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.kegiatan.sosialisasi') ? 'bg-blue-700' : '' }}">
                Kegiatan Sosialisasi
            </a>
            <a href="{{ route('admin.layanan.kegiatan.magang') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.kegiatan.magang') ? 'bg-blue-700' : '' }}">
                Kegiatan Magang
            </a>
            <a href="{{ route('admin.layanan.kegiatan.tes-urine') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.kegiatan.tes-urine') ? 'bg-blue-700' : '' }}">
                Kegiatan Tes Urine Mandiri
            </a>
            <a href="{{ route('admin.layanan.kegiatan.tat') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.kegiatan.tat') ? 'bg-blue-700' : '' }}">
                Kegiatan TAT
            </a>
        </div>
    </div>

    <!-- Layanan Pengaduan Masyarakat -->
    <div x-data="{ open: {{ request()->routeIs('admin.layanan.pengaduan.*') ? 'true' : 'false' }} }">
        <button @click="open = !open" 
                class="flex items-center justify-between w-full px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                Layanan Pengaduan Masyarakat
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': open}"></i>
        </button>
        
        <div x-show="open" class="bg-blue-900">
            <a href="{{ route('admin.layanan.pengaduan.gratifikasi') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.pengaduan.gratifikasi') ? 'bg-blue-700' : '' }}">
                Pelaporan Gratifikasi
            </a>
            <a href="{{ route('admin.layanan.pengaduan.whistleblower') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.pengaduan.whistleblower') ? 'bg-blue-700' : '' }}">
                Whistle Blowing System
            </a>
            <a href="{{ route('admin.layanan.pengaduan.narkoba') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.pengaduan.narkoba') ? 'bg-blue-700' : '' }}">
                Pelaporan Penyalahgunaan Narkoba
            </a>
            <a href="{{ route('admin.layanan.pengaduan.kritik-saran') }}" 
               class="block px-8 py-2 text-sm text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.layanan.pengaduan.kritik-saran') ? 'bg-blue-700' : '' }}">
                Kritik, Saran dan Pengaduan Layanan
            </a>
        </div>
    </div>

    <!-- Kelola Admin -->
    <a href="{{ route('admin.administrators.index') }}" 
       class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 {{ request()->routeIs('admin.administrators.*') ? 'bg-blue-700' : '' }}">
        <i class="fas fa-users-cog mr-3"></i>
        Kelola Admin
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('admin.logout') }}" class="pt-4">
        @csrf
        <button type="submit" 
                class="flex items-center px-4 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-150 w-full text-left">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Logout
        </button>
    </form>
</div>