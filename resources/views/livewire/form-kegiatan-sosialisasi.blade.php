<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Form Kegiatan Sosialisasi</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">

        <!-- Jenis Sosialisasi -->
        <div>
            <label class="block mb-1 font-medium">Jenis Sosialisasi</label>
            <select wire:model="jenis_sosialisasi" class="w-full border rounded p-2">
                <option value="">-- Pilih Jenis Sosialisasi --</option>
                <option value="Masyarakat">Masyarakat</option>
                <option value="Pemerintah">Pemerintah</option>
                <option value="Swasta">Swasta</option>
                <option value="Pendidikan">Pendidikan</option>
            </select>
            @error('jenis_sosialisasi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nama Penyelenggara -->
        <div>
            <label class="block mb-1 font-medium">Nama Penyelenggara</label>
            <input type="text" wire:model="penyelenggara" class="w-full border rounded p-2">
            @error('penyelenggara') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block mb-1 font-medium">Tanggal</label>
            <input type="date" wire:model="tanggal" class="w-full border rounded p-2">
            @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Waktu -->
        <div>
            <label class="block mb-1 font-medium">Waktu</label>
            <input type="time" wire:model="waktu" class="w-full border rounded p-2">
            @error('waktu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tempat -->
        <div>
            <label class="block mb-1 font-medium">Tempat</label>
            <input type="text" wire:model="tempat" class="w-full border rounded p-2">
            @error('tempat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Penanggung Jawab -->
        <div>
            <label class="block mb-1 font-medium">Nama Penanggung Jawab</label>
            <input type="text" wire:model="penanggung_jawab" class="w-full border rounded p-2">
            @error('penanggung_jawab') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nomor HP -->
        <div>
            <label class="block mb-1 font-medium">Nomor HP Penanggung Jawab</label>
            <input type="text" wire:model="no_hp" class="w-full border rounded p-2">
            @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Jumlah Peserta -->
        <div>
            <label class="block mb-1 font-medium">Jumlah Peserta</label>
            <input type="number" wire:model="jumlah_peserta" class="w-full border rounded p-2">
            @error('jumlah_peserta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Keterangan -->
        <div>
            <label class="block mb-1 font-medium">Keterangan</label>
            <textarea wire:model="keterangan" class="w-full border rounded p-2"></textarea>
        </div>

        <!-- Lampiran -->
        <div>
            <label class="block mb-1 font-medium">Lampiran Surat Undangan</label>
            <input type="file" wire:model="lampiran" class="w-full border rounded p-2">
            @error('lampiran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div wire:loading wire:target="lampiran" class="text-blue-600 mt-1 text-sm">Mengunggah...</div>
        </div>

        <button type="submit" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
            Kirim Formulir
        </button>
    </form>
</div>
