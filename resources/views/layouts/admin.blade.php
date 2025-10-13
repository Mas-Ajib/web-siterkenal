<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Siterkenal - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
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
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Overlay (untuk mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-blue-800 text-white sidebar-transition fixed lg:relative h-full z-30 -translate-x-full lg:translate-x-0 flex flex-col">
            <!-- Header Sidebar -->
            <div class="p-4 border-b border-blue-700">
                <div class="flex items-center justify-between">
                    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN" class="h-12 w-auto mr-3">
                    <div>
                        <h1 class="text-2xl font-bold">Admin SITERKENAL</h1>
                        <p class="text-sm text-blue-200">Panel Administrator</p>
                    </div>
                    <!-- Tombol Close untuk Desktop -->
                    <button id="close-sidebar-desktop" class="hidden lg:block text-blue-200 hover:text-white">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
            </div>
            
            <!-- Navigation Menu dengan Scroll -->
            <nav class="mt-6 flex-1 overflow-y-auto sidebar-scroll pb-4">
                <x-admin.sidebar-menu />
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden content-transition lg:ml-0 min-w-0">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <!-- Hamburger Button untuk Mobile & Desktop -->
                        <button id="hamburger-btn" class="flex flex-col w-6 h-5 justify-between">
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                            <div class="hamburger-line w-full h-0.5 bg-gray-700 rounded"></div>
                        </button>
                        
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        {{-- <span class="text-gray-600">Welcome, {{ Auth::guard('admin')->user()->name }}</span> --}}
                        <x-admin.profile-dropdown />
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
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

                @yield('content')
            </main>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const closeSidebarDesktop = document.getElementById('close-sidebar-desktop');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            
            // State sidebar (true = terbuka, false = tertutup)
            let sidebarOpen = window.innerWidth >= 1024;
            
            // Toggle sidebar
            function toggleSidebar() {
                sidebarOpen = !sidebarOpen;
                
                if (window.innerWidth >= 1024) {
                    // Desktop behavior
                    if (sidebarOpen) {
                        sidebar.classList.remove('lg:-ml-64');
                        sidebar.classList.add('lg:relative');
                        mainContent.classList.remove('lg:ml-0');
                        closeSidebarDesktop.innerHTML = '<i class="fas fa-chevron-left"></i>';
                    } else {
                        sidebar.classList.add('lg:-ml-64');
                        sidebar.classList.remove('lg:relative');
                        mainContent.classList.add('lg:ml-0');
                        closeSidebarDesktop.innerHTML = '<i class="fas fa-chevron-right"></i>';
                    }
                } else {
                    // Mobile behavior
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                    hamburgerBtn.classList.toggle('hamburger-active');
                }
            }
            
            // Close sidebar (hanya untuk mobile)
            function closeSidebar() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                    hamburgerBtn.classList.remove('hamburger-active');
                    sidebarOpen = false;
                }
            }
            
            // Event listeners
            hamburgerBtn.addEventListener('click', toggleSidebar);
            closeSidebarDesktop.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);
            
            // Close sidebar when clicking on a link (mobile only)
            const sidebarLinks = document.querySelectorAll('#sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    // Desktop
                    sidebar.classList.remove('-translate-x-full', 'fixed');
                    sidebarOverlay.classList.add('hidden');
                    hamburgerBtn.classList.remove('hamburger-active');
                    
                    if (sidebarOpen) {
                        sidebar.classList.remove('lg:-ml-64');
                        sidebar.classList.add('lg:relative');
                        mainContent.classList.remove('lg:ml-0');
                    } else {
                        sidebar.classList.add('lg:-ml-64');
                        sidebar.classList.remove('lg:relative');
                        mainContent.classList.add('lg:ml-0');
                    }
                } else {
                    // Mobile
                    sidebar.classList.add('-translate-x-full', 'fixed');
                    sidebar.classList.remove('lg:-ml-64', 'lg:relative');
                    mainContent.classList.remove('lg:ml-0');
                    
                    if (!sidebarOpen) {
                        sidebar.classList.add('-translate-x-full');
                    }
                }
            });

            // Initialize sidebar state based on screen size
            if (window.innerWidth >= 1024 && !sidebarOpen) {
                toggleSidebar(); // Buka sidebar secara default di desktop
            }
        });
    </script>
</body>
</html>