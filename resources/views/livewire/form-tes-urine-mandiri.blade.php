<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Formulir Permohonan Tes Urine Mandiri</h2>

    @if (session()->has('success'))
        <div class="p-3 mb-3 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block">Jenis Tes Urine Mandiri</label>
            <select wire:model="jenis_tes" class="w-full border rounded p-2">
                <option value="">-- Pilih Jenis --</option>
                <option value="Masyarakat">Masyarakat</option>
                <option value="Pemerintah">Pemerintah</option>
                <option value="Swasta">Swasta</option>
                <option value="Pendidikan">Pendidikan</option>
            </select>
            @error('jenis_tes') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">Nama Penyelenggara</label>
            <input type="text" wire:model="nama_penyelenggara" class="w-full border rounded p-2">
            @error('nama_penyelenggara') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Tanggal</label>
                <input type="date" wire:model="tanggal" class="w-full border rounded p-2">
                @error('tanggal') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label>Waktu</label>
                <input type="time" wire:model="waktu" class="w-full border rounded p-2">
                @error('waktu') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label>Tempat</label>
            <input type="text" wire:model="tempat" class="w-full border rounded p-2">
            @error('tempat') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Nama Penanggung Jawab</label>
            <input type="text" wire:model="nama_penanggung_jawab" class="w-full border rounded p-2">
            @error('nama_penanggung_jawab') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Nomor HP Penanggung Jawab</label>
            <input type="text" wire:model="nohp_penanggung_jawab" class="w-full border rounded p-2">
            @error('nohp_penanggung_jawab') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Jumlah Peserta</label>
            <input type="number" wire:model="jumlah_peserta" class="w-full border rounded p-2">
            @error('jumlah_peserta') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Keterangan</label>
            <textarea wire:model="keterangan" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label>Lampiran Surat Undangan</label>
            <input type="file" wire:model="lampiran" class="w-full">
            @error('lampiran') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
            Kirim Formulir
        </button>
    </form>
</div>
