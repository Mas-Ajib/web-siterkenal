<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Formulir Permohonan Magang / Riset</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
        
        <div>
            <label class="block mb-1 font-medium">Nama Lengkap</label>
            <input type="text" wire:model="nama_lengkap" class="w-full border rounded p-2">
            @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Nama Instansi / Organisasi</label>
            <input type="text" wire:model="instansi" class="w-full border rounded p-2">
            @error('instansi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Nama Penanggung Jawab</label>
            <input type="text" wire:model="penanggung_jawab" class="w-full border rounded p-2">
            @error('penanggung_jawab') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Nomor Kontak (WhatsApp)</label>
            <input type="text" wire:model="kontak" class="w-full border rounded p-2">
            @error('kontak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Jangka Waktu Pelaksanaan</label>
            <input type="text" wire:model="jangka_waktu" class="w-full border rounded p-2" placeholder="Contoh: 1 Juli - 30 Agustus 2025">
            @error('jangka_waktu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Jumlah Peserta Magang/Riset</label>
            <input type="number" wire:model="jumlah_peserta" class="w-full border rounded p-2">
            @error('jumlah_peserta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label class="block mb-1 font-medium">Lampiran Surat Pengantar/Permohonan</label>
            <input type="file" wire:model="lampiran" class="w-full border rounded p-2">
            @error('lampiran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div wire:loading wire:target="lampiran" class="text-blue-600 mt-1 text-sm">Mengunggah...</div>
        </div>
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim
        </button>
    </form>
</div>
