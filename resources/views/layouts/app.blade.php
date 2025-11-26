<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITERKENAL</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite('resources/css/app.css')
    @livewireStyles

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
    <link rel="icon" href="{{ asset('icon.png') }}">
</head>
<body class="bg-gradient-to-r from-blue-900 to-blue-500 text-slate-800">
    
    <!-- Header/Navbar -->
<header class="bg-white shadow-md" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo & Title -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNN" class="h-10 w-auto mr-3">
                <span class="text-xl font-bold text-blue-900">SITERKENAL</span>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6 ml-auto">
                <a href="{{ route('beranda') }}" class="text-gray-700 hover:text-blue-600 font-semibold">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-blue-900 hover:text-blue-600 font-semibold">Tentang Kami</a>

                <!-- Dropdown Layanan -->
                <div class="relative group">
                    <button class="text-blue-900 hover:text-blue-600 font-semibold focus:outline-none">
                        Layanan
                    </button>
                    <div class="absolute right-0 hidden mt-2 w-48 bg-white text-black rounded-lg shadow-lg 
                                group-hover:block group-focus-within:block">
                        <a href="https://drive.google.com/file/d/1lIG-vtdnMb470l7bBZS3uoJW2RBOtnEj/view" class="block px-4 py-2 hover:bg-gray-100">SKHPN</a>
                        <a href="/rehabilitasi" class="block px-4 py-2 hover:bg-gray-100">Rehabilitasi</a>
                        <a href="/kegiatan" class="block px-4 py-2 hover:bg-gray-100">Kegiatan</a>
                        <a href="/ppid-informasi" class="block px-4 py-2 hover:bg-gray-100">PPID</a>
                        <a href="/pengaduan" class="block px-4 py-2 hover:bg-gray-100">Pengaduan</a>
                    </div>
                </div>

                <!-- Login -->
                <a href="/admin/login" class="bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 transition">
                    Login
                </a>
            </nav>


            <!-- Mobile Hamburger -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-blue-900 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden bg-white shadow-lg">
        <nav class="px-4 pt-4 pb-6 space-y-2">
            <a href="{{ route('beranda') }}" class="block text-gray-700 font-semibold hover:text-blue-600">Beranda</a>
            <a href="{{ route('tentang') }}" class="block text-gray-700 font-semibold hover:text-blue-600">Tentang Kami</a>

            <!-- Dropdown Layanan di Mobile -->
            <div x-data="{ layananOpen: false }">
                <button @click="layananOpen = !layananOpen" class="flex justify-between items-center w-full text-gray-700 font-semibold hover:text-blue-600">
                    Layanan
                    <i :class="layananOpen ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas ml-2"></i>
                </button>
                <div x-show="layananOpen" class="pl-4 mt-2 space-y-1">
                    <a href="https://drive.google.com/file/d/1lIG-vtdnMb470l7bBZS3uoJW2RBOtnEj/view" class="block text-gray-600 hover:text-blue-600">SKHPN</a>
                    <a href="{{ route('form.rehabilitasi') }}" class="block text-gray-600 hover:text-blue-600">Rehabilitasi</a>
                    <a href="{{ route('form.kegiatan') }}" class="block text-gray-600 hover:text-blue-600">Kegiatan</a>
                    <a href="/ppid-informasi" class="block text-gray-600 hover:text-blue-600">PPID</a>
                    <a href="{{ route('form.pengaduan') }}" class="block text-gray-600 hover:text-blue-600">Pengaduan</a>
                </div>
            </div>

            <a href="/admin/login" class="block bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-800 transition text-center">
                Login
            </a>
        </nav>
    </div>
</header>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    
    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-6 mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <!-- Judul Sosial Media -->
            <h2 class="text-lg font-semibold mb-3">Ikuti Media Sosial Kami</h2>

            <!-- Ikon Sosial Media -->
            <div class="flex justify-center space-x-6 mb-4">
                <a href="https://www.instagram.com/bnnk_kendal" target="_blank" class="hover:text-pink-400 transition">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
                <a href="https://www.facebook.com/bnnkabupaten.kendal?mibextid=ZbWKwL" target="_blank" class="hover:text-blue-400 transition">
                    <i class="fab fa-facebook text-2xl"></i>
                </a>
                <a href="https://x.com/bnnk_kendal" target="_blank" class="hover:text-sky-400 transition">
                    <i class="fab fa-twitter text-2xl"></i>
                </a>
                <a href="https://www.youtube.com/@bnnkabkendal" target="_blank" class="hover:text-red-500 transition">
                    <i class="fab fa-youtube text-2xl"></i>
                </a>
                <a href="https://www.tiktok.com/@bnnkkendal" target="_blank" class="hover:text-gray-200 transition">
                    <i class="fab fa-tiktok text-2xl"></i>
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-sm">&copy; {{ date('Y') }} SITERKENAL - BNNK Kendal. All Rights Reserved.</p>
        </div>
    </footer>


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-awesome-kit.js" crossorigin="anonymous"></script>

    @livewireScripts

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
