<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Form Permohonan Tim Asesment Terpadu (TAT)</h2>

    @if (session()->has('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block font-medium">Instansi Pemohon</label>
            <input type="text" wire:model="instansi_pemohon" class="w-full border rounded p-2">
            @error('instansi_pemohon') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Nama Tersangka</label>
            <input type="text" wire:model="nama_tersangka" class="w-full border rounded p-2">
            @error('nama_tersangka') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Tanggal Penangkapan</label>
            <input type="date" wire:model="tanggal_penangkapan" class="w-full border rounded p-2">
            @error('tanggal_penangkapan') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Jenis Barang Bukti</label>
            <input type="text" wire:model="jenis_barang_bukti" class="w-full border rounded p-2">
            @error('jenis_barang_bukti') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Berat Barang Bukti</label>
            <input type="text" wire:model="berat_barang_bukti" class="w-full border rounded p-2">
            @error('berat_barang_bukti') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Hasil Urine Sementara</label>
            <input type="text" wire:model="hasil_urine" class="w-full border rounded p-2">
            @error('hasil_urine') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Surat Permohonan (PDF)</label>
            <input type="file" wire:model="surat_permohonan" class="w-full border rounded p-2">
            @error('surat_permohonan') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Kirim</button>
    </form>
</div>
