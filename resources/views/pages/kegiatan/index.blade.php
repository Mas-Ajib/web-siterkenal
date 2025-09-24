@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-blue-600">Pilih Jenis Kegiatan</h2>
        <ul class="space-y-3">
            <li>
                <a href="{{ route('form.kegiatan.sosialisasi') }}" class="block p-3 bg-blue-100 rounded hover:bg-blue-200">
                    Sosialisasi
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.tesurine') }}" class="block p-3 bg-blue-100 rounded hover:bg-blue-200">
                    Tes Urine Mandiri
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.magang') }}" class="block p-3 bg-blue-100 rounded hover:bg-blue-200">
                    Magang / Riset
                </a>
            </li>
            <li>
                <a href="{{ route('form.kegiatan.tat') }}" class="block p-3 bg-blue-100 rounded hover:bg-blue-200">
                    Permohonan Tim Asesment Terpadu (TAT)
                </a>
            </li>
        </ul>
    </div>
@endsection
