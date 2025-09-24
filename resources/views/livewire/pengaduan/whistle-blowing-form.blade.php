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
        <h2 class="text-xl font-bold text-blue-800 mb-3">Formulir Whistle Blowing System</h2>
        <p class="mb-3">Dalam rangka mewujudkan reformasi birokrasi melalui Pembangunan Zona Integritas (ZI) di lingkungan BNN Kabupaten Kendal, diperlukan penguatan dari aspek birokrasi yang bersih dan bebas dari korupsi serta praktik-praktik kecurangan lainnya.</p>
        <p class="mb-3">Kami sangat menghargai dan memberikan apresiasi setinggi-tingginya kepada masyarakat yang melaporkan pengaduan terhadap dugaan penyimpangan yang ada di BNN Kabupaten Kendal.</p>
        <p class="italic">Kami tidak meminta data pribadi yang berhubungan dengan Anda secara langsung kecuali jika tindak lanjut dari pengaduan tersebut membutuhkan data pribadi Anda.</p>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="submit">
        <!-- Jenis Pelanggaran -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran <span class="text-red-600">*</span></label>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="radio" id="penyimpangan" wire:model="jenis_pelanggaran" value="Penyimpangan dari Tugas dan Fungsi" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="penyimpangan" class="ml-2 block text-sm text-gray-700">Penyimpangan dari Tugas dan Fungsi</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="benturan" wire:model="jenis_pelanggaran" value="Benturan Kepentingan" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="benturan" class="ml-2 block text-sm text-gray-700">Benturan Kepentingan</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="peraturan" wire:model="jenis_pelanggaran" value="Melanggar Peraturan dan Perundangan Yang Berlaku" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="peraturan" class="ml-2 block text-sm text-gray-700">Melanggar Peraturan dan Perundangan Yang Berlaku</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="korupsi" wire:model="jenis_pelanggaran" value="Tindak Pidana Korupsi" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="korupsi" class="ml-2 block text-sm text-gray-700">Tindak Pidana Korupsi</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="lainnya" wire:model="jenis_pelanggaran" value="Lainnya" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="lainnya" class="ml-2 block text-sm text-gray-700">Yang Lain:</label>
                </div>
            </div>
            @error('jenis_pelanggaran') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            
            @if($jenis_pelanggaran === 'Lainnya')
            <div class="mt-3">
                <input type="text" wire:model="jenis_pelanggaran_lainnya" placeholder="Jenis pelanggaran lainnya" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('jenis_pelanggaran_lainnya') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            @endif
        </div>

        <!-- Nama Pelapor -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Nama Pelapor (Opsional)</label>
            <input type="text" wire:model="nama_pelapor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('nama_pelapor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Lokasi Kejadian -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Lokasi Kejadian <span class="text-red-600">*</span></label>
            <input type="text" wire:model="lokasi_kejadian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('lokasi_kejadian') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Kota/Kabupaten dan Provinsi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Kota / Kabupaten <span class="text-red-600">*</span></label>
                <input type="text" wire:model="kota_kabupaten" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('kota_kabupaten') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Provinsi <span class="text-red-600">*</span></label>
                <input type="text" wire:model="provinsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('provinsi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Tanggal dan Waktu Kejadian -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Perkiraan Kejadian <span class="text-red-600">*</span></label>
                <input type="date" wire:model="tanggal_kejadian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('tanggal_kejadian') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Waktu Perkiraan Kejadian (Opsional)</label>
                <input type="time" wire:model="waktu_kejadian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('waktu_kejadian') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Uraian Pengaduan -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Uraian Singkat Pengaduan <span class="text-red-600">*</span></label>
            <textarea wire:model="uraian_pengaduan" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan secara singkat dan jelas tentang pengaduan Anda"></textarea>
            @error('uraian_pengaduan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Email (Opsional)</label>
            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="email@contoh.com">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Pernyataan -->
        <div class="mb-6">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="pernyataan" wire:model="pernyataan" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="pernyataan" class="font-medium text-gray-700">Data yang saya berikan benar dan dapat dipertanggung jawabkan <span class="text-red-600">*</span></label>
                </div>
            </div>
            @error('pernyataan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Kirim Laporan
            </button>
        </div>
    </form>
</div>