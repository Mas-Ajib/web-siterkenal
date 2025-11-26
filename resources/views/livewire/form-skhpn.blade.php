<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-6">
    <h2 class="text-2xl font-bold mb-4">Form Layanan SKHPN</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block font-medium">Nama Lengkap</label>
            <input type="text" wire:model="nama" class="w-full border rounded p-2">
            @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">NIK</label>
            <input type="text" wire:model="nik" class="w-full border rounded p-2">
            @error('nik') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Alamat</label>
            <textarea wire:model="alamat" class="w-full border rounded p-2"></textarea>
            @error('alamat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">No. HP</label>
            <input type="text" wire:model="no_hp" class="w-full border rounded p-2">
            @error('no_hp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Tujuan</label>
            <input type="text" wire:model="tujuan" class="w-full border rounded p-2">
            @error('tujuan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow-lg transition">
            Kirim Formulir
        </button>

    </form>
</div>
