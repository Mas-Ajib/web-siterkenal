@extends('layouts.app')

@section('content')
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-white mb-4">
            Selamat Datang di <span class="text-yellow-300">SITERKENAL</span>
        </h1>
        <p class="text-lg text-white">
            (Sistem Informasi Terpadu BNNK Kendal)
        </p>
    </div>

    <!-- Pilihan Layanan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Call Center -->
        <a href="https://wa.me/628975419000" 
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📞 Call Center BNNK Kendal</h2>
        </a>

        <!-- Website BNN Kabupaten Kendal -->
        <a href="https://kendalkab.bnn.go.id/" target="_blank"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">🌐 Website BNN Kabupaten Kendal</h2>
        </a>

        <!-- SKHPN -->
        <a href="https://drive.google.com/file/d/1lIG-vtdnMb470l7bBZS3uoJW2RBOtnEj/view"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📝 Layanan SKHPN</h2>
        </a>

        <!-- Rehabilitasi -->
        <a href="{{ route('form.rehabilitasi') }}"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">💊 Layanan Rehabilitasi</h2>
        </a>

        <!-- Permohonan Kegiatan -->
        <a href="{{ route('form.kegiatan') }}"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📌 Permohonan Kegiatan</h2>
        </a>

        <!-- Pengaduan Masyarakat -->
        <a href="{{ route('form.pengaduan') }}"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📢 Pengaduan Masyarakat</h2>
        </a>

        <!-- Survey Kepuasan -->
        <a href="https://survei.bnn.go.id/#menu" target="_blank"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📊 Survey Kepuasan Masyarakat</h2>
        </a>

        <!-- Lapor Kemenpan -->
        <a href="https://www.lapor.go.id/" target="_blank"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">📮 Lapor (Kemenpan)</h2>
        </a>

        <!-- IRWASRIKSUS -->
        <a href="https://bnn.go.id/satuan-kerja/ittama/pengaduan/" target="_blank"
           class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg hover:bg-blue-50 transition text-center">
            <h2 class="font-semibold text-blue-900">🔎 IRWASRIKSUS</h2>
        </a>
    </div>
@endsection
