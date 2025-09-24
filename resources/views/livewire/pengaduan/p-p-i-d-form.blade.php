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

    <!-- Deskripsi PPID -->
    <div class="bg-blue-50 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-bold text-blue-800 mb-3">PPID (Prosedur Permohonan Informasi di BNN Kabupaten Kendal)</h2>
        <p class="mb-3">Berikut adalah prosedur permohonan informasi terkait tugas dan fungsi kami sebagai instansi pelaksana Pencegahan dan Pemberantasan Penyalahgunaan dan Peredaran gelap Narkotika :</p>
        
        <ol class="list-decimal pl-5 space-y-2 text-sm">
            <li>Layanan informasi di BNN Kabupaten Kendal dikelola secara terpusat (satu pintu) oleh Bagian Informasi dan berkoordinasi dengan Pejabat Pengelola Informasi dan Dokumentasi (PPID) BNN RI;</li>
            <li>Unit layanan informasi publik diselenggarakan oleh Pejabat Pengelola Informasi dan Dokumentasi (PPID) BNN Kabupaten Kendal dengan alamat Jalan Gajahmada, Karangsari, Kabupaten Kendal;</li>
            <li>Permohonan informasi ke BNN Kabupaten Kendal dapat disampaikan secara langsung ke kantor maupun melalui surat ke alamat Jalan Gajahmada, Karangsari, Kabupaten Kendal, surat elektronik ke alamat bnnkkendal@gmail.com; telepon (0294) 388702 atau faksimili (0294) 388157;</li>
            <li>Pemohon informasi wajib memperhatikan ketentuan yang berlaku, sebagai berikut:
                <ul class="list-disc pl-5 mt-1">
                    <li>Jika pemohon informasi mengatasnamakan pribadi, wajib melampirkan foto copy KTP;</li>
                    <li>Jika pemohon informasi mengatasnamakan LSM (Lembaga Swadaya Masyarakat), wajib menyertakan akte notaris yang mencantumkan nomor registrasi bahwa LSM tersebut terdaftar di Kementerian Hukum dan HAM atau Kementerian Dalam Negeri;</li>
                    <li>Jika pemohon informasi mengatasnamakan perusahaan, wajib menyertakan akte pendirian perusahaan.</li>
                </ul>
            </li>
            <li>Sesuai ketentuan Undang-undang Keterbukaan Informasi Publik Nomor 14 Tahun 2008, jangka waktu pemenuhan informasi berlangsung selama 10 (sepuluh) hari kerja dan dapat di tambah 7 (tujuh) hari kerja dengan pemberitahuan terlebih dahulu;</li>
            <li>Jadwal pelayanan informasi sebagai berikut:
                <ul class="list-disc pl-5 mt-1">
                    <li>Senin-Kamis : Pukul 09.00-12.00 WIB dan Pukul 13.00-15.00 WIB</li>
                    <li>Jumat : Pukul 09.00-11.30 WIB dan Pukul 13.30-15.00 WIB</li>
                </ul>
            </li>
            <li>Pemohon informasi tidak dipungut biaya, jika ada dokumen yang harus di fotocopy dan penggandaan dalam bentuk CD/DVD maka dibebankan kepada pemohon informasi;</li>
            <li>Informasi lebih lengkap mengenai permohonan informasi di Badan Narkotika Nasional RI dapat mengunjungi laman : <a href="https://ppid.bnn.go.id" target="_blank" class="text-blue-600 hover:underline">https://ppid.bnn.go.id</a></li>
        </ol>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="submit">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">FORMULIR PERMOHONAN INFORMASI</h2>
        
        <!-- Nama Pemohon -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Nama Pemohon Informasi <span class="text-red-600">*</span></label>
            <input type="text" wire:model="nama_pemohon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('nama_pemohon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Alamat <span class="text-red-600">*</span></label>
            <textarea wire:model="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('alamat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nomor Handphone -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Nomor Handphone (WhatsApp) <span class="text-red-600">*</span></label>
            <input type="text" wire:model="nomor_handphone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="081234567890">
            @error('nomor_handphone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Email <span class="text-red-600">*</span></label>
            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="email@contoh.com">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Informasi Yang Dibutuhkan -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Informasi Yang Dibutuhkan <span class="text-red-600">*</span></label>
            <textarea wire:model="informasi_dibutuhkan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan secara detail informasi yang Anda butuhkan"></textarea>
            @error('informasi_dibutuhkan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alasan Meminta Informasi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Alasan Meminta Informasi <span class="text-red-600">*</span></label>
            <textarea wire:model="alasan_meminta" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan alasan Anda meminta informasi tersebut"></textarea>
            @error('alasan_meminta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Cara Memperoleh Informasi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Cara Memperoleh Informasi <span class="text-red-600">*</span></label>
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input type="radio" id="melihat" wire:model="cara_memperoleh" value="Melihat/membaca/mendengarkan/mencatat" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="melihat" class="ml-2 block text-sm text-gray-700">Melihat/membaca/mendengarkan/mencatat</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="salinan" wire:model="cara_memperoleh" value="Mendapatkan Salinan Informasi (Hardcopy/Softcopy)" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="salinan" class="ml-2 block text-sm text-gray-700">Mendapatkan Salinan Informasi (Hardcopy/Softcopy)</label>
                </div>
            </div>
            @error('cara_memperoleh') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Cara Mengirim Informasi -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Cara Mengirim Informasi <span class="text-red-600">*</span></label>
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input type="radio" id="diambil" wire:model="cara_mengirim" value="Diambil Langsung" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="diambil" class="ml-2 block text-sm text-gray-700">Diambil Langsung</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="kurir" wire:model="cara_mengirim" value="Kurir" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="kurir" class="ml-2 block text-sm text-gray-700">Kurir</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="pos" wire:model="cara_mengirim" value="Pos" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="pos" class="ml-2 block text-sm text-gray-700">Pos</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="email_kirim" wire:model="cara_mengirim" value="Email" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="email_kirim" class="ml-2 block text-sm text-gray-700">Email</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="faksimili" wire:model="cara_mengirim" value="Faksimili" class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                    <label for="faksimili" class="ml-2 block text-sm text-gray-700">Faksimili</label>
                </div>
            </div>
            @error('cara_mengirim') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Informasi Penting -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.