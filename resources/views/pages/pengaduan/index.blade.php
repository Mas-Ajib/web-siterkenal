@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-white mb-6">
            Pilih Jenis Pengaduan Masyarakat
        </h1>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('form.pengaduan.gratifikasi') }}"
                    class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Pelaporan Gratifikasi
                </a>
            </li>
            <li>
                <a href="{{ route('form.pengaduan.whistleblowing') }}"
                    class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Whistle Blowing System
                </a>
            </li>
            <li>
                <a href="{{ route('form.pengaduan.penyalahgunaan') }}"
                    class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Pelaporan Penyalahgunaan Narkoba
                </a>
            </li>
            <li>
                <a href="{{ route('form.pengaduan.kritik') }}" class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Kritik, Saran dan Pengaduan Layanan
                </a>
            </li>
        </ul>
    </div>
@endsection
