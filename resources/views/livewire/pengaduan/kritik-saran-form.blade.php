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

    <!-- Judul -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Formulir Kritik, Saran dan Pengaduan Layanan</h1>
        <p class="text-gray-600 mt-2">Sampaikan pendapat Anda untuk membantu kami meningkatkan kualitas pelayanan</p>
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
            <label class="block text-sm font-medium text-gray-700">Nomor Telepon (Opsional)</label>
            <input type="text" wire:model="telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="081234567890">
            @error('telepon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kritik -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Kritik (Opsional)</label>
            <textarea wire:model="kritik" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Sampaikan kritik konstruktif Anda"></textarea>
            @error('kritik') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Saran -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Saran (Opsional)</label>
            <textarea wire:model="saran" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Berikan saran untuk perbaikan pelayanan"></textarea>
            @error('saran') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Pengaduan Layanan -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Pengaduan Layanan (Opsional)</label>
            <textarea wire:model="pengaduan_layanan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Laporkan pengaduan terkait layanan yang diterima"></textarea>
            @error('pengaduan_layanan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Informasi -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Harap diperhatikan:</strong> Minimal salah satu dari Kritik, Saran, atau Pengaduan Layanan harus diisi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Kirim
            </button>
        </div>
    </form>
</div>