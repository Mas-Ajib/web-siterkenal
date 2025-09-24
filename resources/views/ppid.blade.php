@extends('components.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold text-blue-900 mb-6">Form Permohonan Informasi PPID</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('form.ppid.submit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nama Pemohon Informasi</label>
            <input type="text" name="nama_pemohon" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block font-semibold">Nomor Handphone (WhatsApp)</label>
            <input type="text" name="no_hp" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Informasi Yang Dibutuhkan</label>
            <textarea name="informasi_dibutuhkan" class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block font-semibold">Alasan Meminta Informasi</label>
            <textarea name="alasan_permintaan" class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block font-semibold">Cara Memperoleh Informasi</label>
            <select name="cara_memperoleh" class="w-full border rounded p-2" required>
                <option value="">-- Pilih --</option>
                <option value="melihat">Melihat/Membaca/Mendengarkan/Mencatat</option>
                <option value="salinan">Mendapatkan Salinan Informasi (Hardcopy/Softcopy)</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold">Cara Mengirim Informasi</label>
            <select name="cara_mengirim" class="w-full border rounded p-2" required>
                <option value="">-- Pilih --</option>
                <option value="langsung">Diambil Langsung</option>
                <option value="kurir">Kurir</option>
                <option value="pos">Pos</option>
                <option value="email">Email</option>
                <option value="faksimili">Faksimili</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded hover:bg-blue-700">Kirim Permohonan</button>
    </form>
</div>
@endsection
