@extends('layouts.app')

@section('content')
    <style>
        /* Custom styles for animations and refinements (assuming Montserrat is loaded in layout) */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.6, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .header-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { text-shadow: 0 0 5px rgba(255, 193, 7, 0.5); }
            to { text-shadow: 0 0 20px rgba(255, 193, 7, 0.8); }
        }
        /* Ensure Montserrat font if not in layout */
        body {
            font-family: 'Montserrat', sans-serif;
        }
        /* Style khusus untuk item centered (IRWASRIKSUS) */
        .centered-card {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header with animation -->
        <div class="text-center mb-12 fade-in-up">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 header-glow">
                Selamat Datang di <span class="text-yellow-300">SITERKENAL</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 font-medium">
                (Sistem Informasi Terpadu BNNK Kendal)
            </p>
        </div>

        <!-- Pilihan Layanan utama (9 item pertama dalam grid 3x3) with staggered animations -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Call Center -->
            <a href="https://wa.me/628975419000" 
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.1s;">
                <div class="text-4xl mb-4">📞</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Call Center BNNK Kendal
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Hubungi kami via WhatsApp
                </p>
            </a>

            <!-- Website BNN Kabupaten Kendal -->
            <a href="https://kendalkab.bnn.go.id/" target="_blank"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.2s;">
                <div class="text-4xl mb-4">🌐</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Website BNN Kabupaten Kendal
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Kunjungi situs resmi
                </p>
            </a>

            <!-- SKHPN -->
            <a href="https://drive.google.com/file/d/1lIG-vtdnMb470l7bBZS3uoJW2RBOtnEj/view"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.3s;">
                <div class="text-4xl mb-4">📝</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Layanan SKHPN
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Surat Keterangan Hasil Pemeriksaan Narkotika
                </p>
            </a>

            <!-- PPID -->
            <a href="/ppid-informasi"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.4s;">
                <div class="text-4xl mb-4">📜</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Permohonan Informasi (PPID)
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Ajukan permohonan informasi publik
                </p>
            </a>

            <!-- Rehabilitasi -->
            <a href="{{ route('form.rehabilitasi') }}"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.5s;">
                <div class="text-4xl mb-4">💊</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Layanan Rehabilitasi
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Daftar program rehabilitasi
                </p>
            </a>

            <!-- Permohonan Kegiatan -->
            <a href="{{ route('form.kegiatan') }}"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.6s;">
                <div class="text-4xl mb-4">📌</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Permohonan Kegiatan
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Ajukan kegiatan bersama kami
                </p>
            </a>

            <!-- Pengaduan Masyarakat -->
            <a href="{{ route('form.pengaduan') }}"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.7s;">
                <div class="text-4xl mb-4">📢</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Pengaduan Masyarakat
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Laporkan pengaduan Anda
                </p>
            </a>

            <!-- Survey Kepuasan -->
            <a href="https://survei.bnn.go.id/#menu" target="_blank"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.8s;">
                <div class="text-4xl mb-4">📊</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Survey Kepuasan Masyarakat
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Berikan umpan balik Anda
                </p>
            </a>

            <!-- Lapor Kemenpan -->
            <a href="https://www.lapor.go.id/" target="_blank"
               class="group p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center fade-in-up" 
               style="animation-delay: 0.9s;">
                <div class="text-4xl mb-4">📮</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    Lapor (Kemenpan)
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Layanan pengaduan nasional
                </p>
            </a>
        </div>

        <!-- IRWASRIKSUS - Ditempatkan terpisah dan centered di tengah -->
        <div class="flex justify-center mb-8 fade-in-up" style="animation-delay: 1.0s;">
            <a href="https://bnn.go.id/satuan-kerja/ittama/pengaduan/" target="_blank"
               class="group centered-card p-8 bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg card-hover text-center max-w-md w-full">
                <div class="text-4xl mb-4">🔎</div>
                <h2 class="text-xl font-semibold text-blue-900 group-hover:text-blue-700 transition-colors">
                    IRWASRIKSUS
                </h2>
                <p class="text-sm text-gray-600 mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Pengawasan internal BNN
                </p>
            </a>
        </div>
    </div>

    <script>
        // Trigger staggered animations on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.fade-in-up');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1 + 0.1}s`; // Staggered delay
            });
        });
    </script>
@endsection