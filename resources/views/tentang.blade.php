@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <!-- Judul -->
    <h1 class="text-3xl font-bold text-center text-white mb-6">Tentang BNNK Kendal</h1>

    <!-- Alamat -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Tujuan Siterkenal</h2>
        <p class="text-gray-600">
            Tujuan dari website ini adalah untuk memusatkan seluruh layanan Badan Narkotika Nasional (BNN) Kabupaten Kendal dalam satu platform terpadu (satu pintu). Hal ini demi memberikan kemudahan dan efisiensi kepada masyarakat saat mengakses layanan BNN Kabupaten Kendal. Silakan pilih layanan yang Anda butuhkan di menu atas.
        </p>
    </div>

    <!-- Alamat -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Alamat Kantor</h2>
        <p class="text-gray-600">
            Badan Narkotika Nasional Kabupaten Kendal<br>
            Jl. Gajahmada, Srendeng, Karang Sari, Kec. Kendal, Kabupaten Kendal, Jawa Tengah 51319
        </p>
    </div>

    <!-- Google Maps -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Lokasi di Google Maps</h2>
        <div class="w-full h-80">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.729790563072!2d110.20513987454103!3d-6.922869867759167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e705c6a68b87a13%3A0x3a4cd2693fa2369a!2sBNNK%20Kendal%20dan%20Klinik%20Rehabilitasi%20Bina%20Waras!5e0!3m2!1sid!2sid!4v1758518538312!5m2!1sid!2sid" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <p class="text-sm text-gray-500 mt-2">
            Klik peta untuk membuka di Google Maps.
        </p>
    </div>

    <!-- Call Center -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Call Center</h2>
        <p class="text-gray-600">
            Nomor Call Center BNNK Kendal: 
            <a href="tel:+628975419000 class="text-blue-600 hover:underline font-medium">
                628975419000
            </a>
        </p>
    </div>
</div>
@endsection
