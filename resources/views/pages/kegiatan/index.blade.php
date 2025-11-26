@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Pilih Jenis Kegiatan</h2>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('form.kegiatan.sosialisasi') }}" class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Sosialisasi
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.tesurine') }}" class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Tes Urine Mandiri
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.magang') }}" class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Magang / Riset
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.tat') }}" class="block p-4 bg-white shadow rounded hover:bg-blue-50">
                    Permohonan Tim Asesment Terpadu (TAT)
                </a>
            </li>
        </ul>
    </div>
@endsection
