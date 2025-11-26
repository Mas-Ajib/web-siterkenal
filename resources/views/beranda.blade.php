@extends('layouts.app')

@section('content')
    <style>
        /* Custom styles for animations and refinements */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
        }

        .card-hover:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 12px 24px -8px rgba(0, 0, 0, 0.1);
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            animation: fadeInUp 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-glow {
            animation: glow 3s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(255, 193, 7, 0.5), 0 0 10px rgba(255, 193, 7, 0.3);
            }

            to {
                text-shadow: 0 0 20px rgba(255, 193, 7, 0.8), 0 0 30px rgba(255, 193, 7, 0.5);
            }
        }

        /* Style untuk semua kartu agar konsisten */
        .service-card {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
            position: relative;
            overflow: hidden;
        }

        /* Efek overlay saat hover */
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(37, 99, 235, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            border-radius: 1.5rem;
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .service-card .icon {
            font-size: 3rem;
            margin-bottom: 1.25rem;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: grayscale(0.3);
            transform: scale(1);
        }

        .service-card:hover .icon {
            transform: scale(1.1) rotate(5deg);
            filter: grayscale(0);
        }

        .service-card h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e3a8a;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .service-card:hover h2 {
            color: #1d4ed8;
            transform: translateY(-2px);
        }

        .service-card .description {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.5;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transform: translateY(10px);
            position: relative;
            z-index: 2;
        }

        .service-card:hover .description {
            opacity: 1;
            max-height: 100px;
            transform: translateY(0);
        }

        /* Smooth loading untuk grid */
        .grid {
            opacity: 0;
            animation: fadeInGrid 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s forwards;
        }

        @keyframes fadeInGrid {
            to {
                opacity: 1;
            }
        }

        /* Stagger animation untuk kartu individual */
        .service-card {
            animation: cardEntrance 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>

    <div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Header with animation -->
    <div class="text-center mb-24 fade-in-up"> <!-- Increased mb-16 to mb-24 -->
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 header-glow">
            Selamat Datang di <span class="text-yellow-300">SITERKENAL</span>
        </h1>
        <p class="text-xl md:text-2xl text-white/90 font-medium">
            (Sistem Informasi Terpadu BNNK Kendal)
        </p>
    </div>

    <!-- Tambahkan spacer tambahan -->
    <div class="h-10"></div> <!-- Additional spacer -->

    <!-- Pilihan Layanan utama (9 item pertama dalam grid 3x3) with staggered animations -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
        <!-- Call Center -->
        <a href="https://wa.me/628975419000" class="service-card card-hover max-w-md w-full"
            style="animation-delay: 0.1s;">
            <div class="icon">📞</div>
            <h2>Call Center BNNK Kendal</h2>
            <p class="description">Hubungi kami via WhatsApp</p>
        </a>

        <!-- Kartu lainnya tetap sama -->
        <!-- Website BNN Kabupaten Kendal -->
        <a href="https://kendalkab.bnn.go.id/" target="_blank"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.2s;">
            <div class="icon">🌐</div>
            <h2>Website BNN Kabupaten Kendal</h2>
            <p class="description">Kunjungi situs resmi</p>
        </a>

        <!-- SKHPN -->
        <a href="https://drive.google.com/file/d/1lIG-vtdnMb470l7bBZS3uoJW2RBOtnEj/view"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.3s;">
            <div class="icon">📝</div>
            <h2>Layanan SKHPN</h2>
            <p class="description">Surat Keterangan Hasil Pemeriksaan Narkotika</p>
        </a>

        <!-- PPID -->
        <a href="/ppid-informasi"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.4s;">
            <div class="icon">📜</div>
            <h2>Permohonan Informasi (PPID)</h2>
            <p class="description">Ajukan permohonan informasi publik</p>
        </a>

        <!-- Rehabilitasi -->
        <a href="{{ route('form.rehabilitasi') }}"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.5s;">
            <div class="icon">💊</div>
            <h2>Layanan Rehabilitasi</h2>
            <p class="description">Daftar program rehabilitasi</p>
        </a>

        <!-- Permohonan Kegiatan -->
        <a href="{{ route('form.kegiatan') }}"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.6s;">
            <div class="icon">📌</div>
            <h2>Permohonan Kegiatan</h2>
            <p class="description">Ajukan kegiatan Sosialisasi, Magang, TAT, Tes Urine Mandiri bersama kami</p>
        </a>

        <!-- Pengaduan Masyarakat -->
        <a href="{{ route('form.pengaduan') }}"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.7s;">
            <div class="icon">📢</div>
            <h2>Pengaduan Masyarakat</h2>
            <p class="description">Laporkan pengaduan Anda, Penyalahgunaan Narkoba, Gratifikasi, Whistleblowing, Kritik Saran</p>
        </a>

        <!-- Survey Kepuasan -->
        <a href="https://survei.bnn.go.id/#menu" target="_blank"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.8s;">
            <div class="icon">📊</div>
            <h2>Survey Kepuasan Masyarakat</h2>
            <p class="description">Berikan umpan balik Anda</p>
        </a>

        <!-- Lapor Kemenpan -->
        <a href="https://www.lapor.go.id/" target="_blank"
           class="service-card card-hover max-w-md w-full" 
           style="animation-delay: 0.9s;">
            <div class="icon">📮</div>
            <h2>Lapor (Kemenpan)</h2>
            <p class="description">Layanan pengaduan nasional</p>
        </a>
    </div>

    <!-- Spacing antara grid utama dan IRWASRIKSUS -->
    <div class="h-8"></div>

    <!-- IRWASRIKSUS - Ditempatkan terpisah dan centered di tengah -->
    <div class="flex justify-center">
        <a href="https://bnn.go.id/satuan-kerja/ittama/pengaduan/" target="_blank"
           class="service-card card-hover max-w-md w-full"
           style="animation-delay: 1.1s;">
            <div class="icon">🔎</div>
            <h2>ITWASRIKSUS</h2>
            <p class="description">Pengawasan internal BNN</p>
        </a>
    </div>
</div>

    <script>
        // Smooth staggered animations on load
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk header
            const header = document.querySelector('.fade-in-up');
            if (header) {
                header.style.animationDelay = '0.2s';
            }

            // Animasi staggered untuk kartu
            const cards = document.querySelectorAll('.service-card');
            cards.forEach((card, index) => {
                const delay = 0.3 + (index * 0.1);
                card.style.animationDelay = `${delay}s`;

                // Smooth hover effects
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-6px) scale(1.03)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Preload animasi untuk performa yang lebih baik
            requestAnimationFrame(() => {
                document.body.classList.add('animations-ready');
            });
        });

        // Smooth scroll untuk link internal
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endsection
