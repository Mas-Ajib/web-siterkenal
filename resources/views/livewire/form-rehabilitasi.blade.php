<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Form Layanan Rehabilitasi</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Nama Lengkap</label>
            <input type="text" wire:model="nama" class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Alamat</label>
            <textarea wire:model="alamat" class="w-full border rounded p-2 focus:ring focus:ring-blue-300"></textarea>
            @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Nomor HP (WhatsApp)</label>
            <input type="text" wire:model="no_hp" class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
            @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Nama Wali / Ortu / Suami / Istri</label>
            <input type="text" wire:model="wali" class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium">Informasi Singkat Riwayat Penyalahgunaan</label>
            <textarea wire:model="riwayat" class="w-full border rounded p-2 focus:ring focus:ring-blue-300"></textarea>
        </div>

        <button type="submit" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
            Kirim Formulir
        </button>
    </form>
</div>
