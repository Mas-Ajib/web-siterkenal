<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Deskripsi -->
    <div class="bg-blue-50 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-bold text-blue-800 mb-3">Formulir Pelaporan Penyalahgunaan Narkoba</h2>
        <p class="mb-3">Masyarakat mempunyai kesempatan yang seluas-luasnya untuk berperan serta membantu pencegahan dan pemberantasan penyalahgunaan dan peredaran gelap Narkotika dan Prekursor Narkotika (Pasal 104 UU 35/2009).</p>
        <p class="mb-3">Badan Narkotika Nasional Kabupaten Kendal menerima pengaduan dari masyarakat apabila mempunyai informasi terkait adanya dugaan telah terjadi tindak pidana narkotika di lingkungannya.</p>
        <p class="font-semibold text-blue-700">Sebagai bentuk perlindungan, Badan Narkotika Nasional Kabupaten Kendal akan merahasiakan identitas Pelapor.</p>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="submit">
        <!-- Nama -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Nama (Opsional)</label>
            <input type="text" wire:model="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Telepon -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Telepon (Opsional)</label>
            <input type="text" wire:model="telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="081234567890">
            @error('telepon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tempat Kejadian -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Tempat Kejadian <span class="text-red-600">*</span></label>
            <textarea wire:model="tempat_kejadian" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Deskripsikan lokasi kejadian dengan jelas"></textarea>
            @error('tempat_kejadian') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Keterangan -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Keterangan <span class="text-red-600">*</span></label>
            <textarea wire:model="keterangan" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan secara detail tentang kejadian yang ingin dilaporkan"></textarea>
            @error('keterangan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Kirim Laporan
            </button>
        </div>
    </form>
</div>