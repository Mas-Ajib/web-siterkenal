<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Siterkenal - @yield('title')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('icon.png') }}">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        
        .content-transition {
            transition: all 0.3s ease-in-out;
        }
        
        .hamburger-line {
            transition: all 0.3s ease-in-out;
        }
        
        .hamburger-active > div:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .hamburger-active > div:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-active > div:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        
        /* Custom scrollbar untuk sidebar */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }
        
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
        
        /* Overlay untuk mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 20;
            display: none;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        /* Animasi untuk sidebar collapse */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .sidebar-collapsed {
            width: 0;
            min-width: 0;
            overflow: hidden;
        }
        
        .sidebar-expanded {
            width: 16rem; /* 64 = 16rem */
        }
    </style>
    
    <!-- Chart.js di load di head -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Overlay untuk menutup sidebar (mobile only) -->
        <div id="sidebar-overlay" class="sidebar-overlay lg:hidden" onclick="closeSidebar()"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-blue-800 text-white sidebar-transition fixed lg:relative h-full z-30 -translate-x-full lg:translate-x-0 flex flex-col sidebar-expanded">
            <!-- Header Sidebar -->
            <div class="p-4 border-b border-blue-700">
                <div class="flex items-center justify-between">
                    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN" class="h-12 w-auto mr-3">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-2xl font-bold truncate">SITERKENAL</h1>
                        <p class="text-sm text-blue-200 truncate">Panel Administrator</p>
                    </div>
                    {{-- <!-- Tombol close untuk mobile (hanya di dalam sidebar) -->
                    <button id="close-sidebar-mobile" class="lg:hidden text-blue-200 hover:text-white ml-2">
                        <i class="fas fa-times text-lg"></i>
                    </button> --}}
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="mt-6 flex-1 overflow-y-auto sidebar-scroll pb-4">
                @include('components.admin.sidebar-menu')
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden content-transition lg:ml-0 min-w-0">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <!-- Hamburger Button untuk SEMUA DEVICE -->
                        <button id="hamburger-btn" class="flex flex-col w-6 h-5 justify-between">
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                        </button>
                        
                        <!-- Judul halaman (opsional) -->
                        <!-- <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2> -->
                    </div>
                    <div class="flex items-center space-x-4">
                        {{-- <span class="text-gray-600 hidden md:inline">Welcome, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span> --}}
                        <!-- Jika ada profile dropdown -->
                        @if(View::exists('components.admin.profile-dropdown'))
                            @include('components.admin.profile-dropdown')
                        @endif
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <!-- Notifikasi -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Konten halaman -->
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <!-- Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const closeSidebarMobile = document.getElementById('close-sidebar-mobile');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            
            // State: true = sidebar terbuka, false = sidebar tertutup
            let sidebarOpen = window.innerWidth >= 1024;
            
            // Fungsi untuk membuka sidebar (mobile)
            function openSidebarMobile() {
                sidebarOpen = true;
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('active');
                hamburgerBtn.classList.add('hamburger-active');
            }
            
            // Fungsi untuk menutup sidebar (mobile)
            function closeSidebarMobileFunc() {
                sidebarOpen = false;
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.remove('active');
                hamburgerBtn.classList.remove('hamburger-active');
            }
            
            // Fungsi untuk toggle sidebar di desktop
            function toggleSidebarDesktop() {
                sidebarOpen = !sidebarOpen;
                
                if (sidebarOpen) {
                    // Buka sidebar
                    sidebar.classList.remove('lg:-ml-64', 'sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded', 'lg:relative');
                    mainContent.classList.remove('lg:ml-0');
                    hamburgerBtn.classList.remove('hamburger-active');
                } else {
                    // Tutup sidebar
                    sidebar.classList.add('lg:-ml-64', 'sidebar-collapsed');
                    sidebar.classList.remove('lg:relative', 'sidebar-expanded');
                    mainContent.classList.add('lg:ml-0');
                    hamburgerBtn.classList.remove('hamburger-active');
                }
            }
            
            // Fungsi utama untuk toggle sidebar
            function toggleSidebar() {
                if (window.innerWidth >= 1024) {
                    // Desktop behavior
                    toggleSidebarDesktop();
                } else {
                    // Mobile behavior
                    if (sidebarOpen) {
                        closeSidebarMobileFunc();
                    } else {
                        openSidebarMobile();
                    }
                }
            }
            
            // Event listeners
            hamburgerBtn.addEventListener('click', toggleSidebar);
            
            // Tombol close di dalam sidebar (mobile)
            if (closeSidebarMobile) {
                closeSidebarMobile.addEventListener('click', closeSidebarMobileFunc);
            }
            
            // Overlay untuk menutup sidebar (mobile)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebarMobileFunc);
            }
            
            // Menutup sidebar ketika klik link di dalamnya (mobile only)
            const sidebarLinks = document.querySelectorAll('#sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebarMobileFunc();
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    // Desktop mode
                    sidebarOverlay.classList.remove('active');
                    hamburgerBtn.classList.remove('hamburger-active');
                    sidebar.classList.remove('-translate-x-full', 'fixed');
                    
                    // Set state berdasarkan apakah sidebar sedang terbuka
                    if (sidebarOpen) {
                        sidebar.classList.remove('lg:-ml-64', 'sidebar-collapsed');
                        sidebar.classList.add('lg:relative', 'sidebar-expanded');
                        mainContent.classList.remove('lg:ml-0');
                    } else {
                        sidebar.classList.add('lg:-ml-64', 'sidebar-collapsed');
                        sidebar.classList.remove('lg:relative', 'sidebar-expanded');
                        mainContent.classList.add('lg:ml-0');
                    }
                } else {
                    // Mobile mode
                    sidebar.classList.add('-translate-x-full', 'fixed');
                    sidebar.classList.remove('lg:-ml-64', 'lg:relative', 'sidebar-collapsed', 'sidebar-expanded');
                    mainContent.classList.remove('lg:ml-0');
                    
                    // Reset state untuk mobile
                    sidebarOpen = false;
                }
            });
            
            // Initialize based on screen size
            function initializeSidebar() {
                if (window.innerWidth >= 1024) {
                    // Desktop: sidebar terbuka default
                    sidebarOpen = true;
                    sidebar.classList.remove('-translate-x-full', 'lg:-ml-64', 'sidebar-collapsed');
                    sidebar.classList.add('lg:relative', 'sidebar-expanded');
                    mainContent.classList.remove('lg:ml-0');
                } else {
                    // Mobile: sidebar tertutup default
                    sidebarOpen = false;
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('lg:relative', 'lg:-ml-64');
                }
            }
            
            initializeSidebar();
        });
        
        // Fungsi global untuk diakses dari overlay onclick (mobile)
        window.closeSidebar = function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            
            if (sidebar && sidebarOverlay && hamburgerBtn && window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.remove('active');
                hamburgerBtn.classList.remove('hamburger-active');
            }
        };
    </script>
    
    @stack('scripts')
</body>
</html>