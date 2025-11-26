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

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex justify-between mb-2">
            <span class="text-sm font-medium {{ $step >= 1 ? 'text-blue-600' : 'text-gray-500' }}">Data Pribadi</span>
            <span class="text-sm font-medium {{ $step >= 2 ? 'text-blue-600' : 'text-gray-500' }}">Data Penerimaan</span>
            <span class="text-sm font-medium {{ $step >= 3 ? 'text-blue-600' : 'text-gray-500' }}">Data Pemberi</span>
            <span class="text-sm font-medium {{ $step >= 4 ? 'text-blue-600' : 'text-gray-500' }}">Alasan & Kronologi</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $step * 25 }}%"></div>
        </div>
    </div>

    <!-- Introduction -->
    @if($step == 1)
    <div class="bg-blue-50 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-bold mb-3">Penjelasan Tentang Pelaporan Gratifikasi</h2>
        <p class="mb-4">Berdasarkan UU No. 31 tahun 1999 jo UU No. 20 tahun 2001 Pasal 12c ayat 2 dan UU No. 30 tahun 2002 Pasal 16, setiap Pegawai Negeri atau Penyelenggara Negara yang menerima gratifikasi wajib melaporkan kepada Komisi Pemberantasan Korupsi</p>
        
        <h3 class="font-bold mb-2">Contoh-contoh Pemberian yang dapat dikategorikan sebagai Gratifikasi:</h3>
        <ol class="list-decimal pl-5 space-y-2">
            <li>Pemberian hadiah atau uang sebagai ucapan terima kasih karena telah dibantu.</li>
            <li>Hadiah atau sumbangan pada saat perkawinan anak dari pejabat oleh rekanan kantor pejabat tersebut.</li>
            <li>Pemberian tiket perjalanan kepada pejabat atau keluarganya untuk keperluan pribadi secara cuma-cuma.</li>
            <li>Pemberian potongan harga khusus bagi pejabat untuk pembelian barang atau jasa dari rekanan.</li>
            <li>Pemberian biaya atau ongkos naik haji dari rekanan kepada pejabat.</li>
            <li>Pemberian hadiah ulang tahun atau pada acara-acara pribadi lainnya dari rekanan.</li>
            <li>Pemberian hadiah atau souvenir kepada pejabat pada saat kunjungan kerja.</li>
            <li>Pemberian hadiah atau parsel kepada pejabat pada saat hari raya keagamaan, oleh rekanan atau bawahannya.</li>
        </ol>
        
        <p class="mt-4 italic">Seluruh pemberian tersebut di atas, dapat dikategorikan sebagai gratifikasi, apabila ada hubungan kerja atau kedinasan antara pemberi dan dengan pejabat yang menerima, dan/atau semata-mata karena keterkaitan dengan jabatan atau kedudukan pejabat tersebut.</p>
    </div>
    @endif

    <!-- Form Steps -->
    <form wire:submit.prevent="submit">
        <!-- Step 1: Data Pribadi -->
        @if($step == 1)
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Pribadi</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" wire:model="nama_lengkap" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_lengkap') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" wire:model="nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nik') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" wire:model="tempat_lahir" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('tempat_lahir') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" wire:model="tanggal_lahir" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('tanggal_lahir') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan/Pangkat/Golongan</label>
                    <input type="text" wire:model="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('jabatan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Instansi</label>
                    <input type="text" wire:model="nama_instansi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_instansi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Eselon I/II/III/IV/Unit Kerja</label>
                    <input type="text" wire:model="unit_kerja" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('unit_kerja') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon Seluler</label>
                    <input type="text" wire:model="no_seluler" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('no_seluler') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon Rumah</label>
                    <input type="text" wire:model="no_rumah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('no_rumah') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. Telepon Kantor</label>
                    <input type="text" wire:model="no_kantor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('no_kantor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Alamat Kantor</label>
                    <textarea wire:model="alamat_kantor" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('alamat_kantor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                    <textarea wire:model="alamat_pengiriman" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('alamat_pengiriman') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <button type="button" wire:click="nextStep" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
                    Berikutnya
                </button>
            </div>
        </div>
        @endif

        <!-- Step 2: Data Penerimaan -->
        @if($step == 2)
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Penerimaan</h2>
            
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Penerimaan dan Uraian</label>
                    <textarea wire:model="jenis_penerimaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('jenis_penerimaan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga/Nilai Nominal/Taksiran (Rp)</label>
                    <input type="number" wire:model="nilai_nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nilai_nominal') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peristiwa Penerimaan</label>
                    <textarea wire:model="peristiwa_penerimaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('peristiwa_penerimaan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tempat Penerimaan</label>
                        <input type="text" wire:model="tempat_penerimaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tempat_penerimaan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Penerimaan</label>
                        <input type="date" wire:model="tanggal_penerimaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tanggal_penerimaan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                    Kembali
                </button>
                <button type="button" wire:click="nextStep" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
                    Berikutnya
                </button>
            </div>
        </div>
        @endif

        <!-- Step 3: Data Pemberi -->
        @if($step == 3)
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Data Pemberi Gratifikasi</h2>
            
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" wire:model="nama_pemberi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nama_pemberi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pekerjaan dan Jabatan</label>
                    <input type="text" wire:model="pekerjaan_jabatan_pemberi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('pekerjaan_jabatan_pemberi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Hubungan Dengan Pemberi</label>
                    <input type="text" wire:model="hubungan_dengan_pemberi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('hubungan_dengan_pemberi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat/Telpon/Fax/Email</label>
                    <textarea wire:model="alamat_pemberi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Alamat lengkap, telepon, fax, dan email pemberi"></textarea>
                    @error('alamat_pemberi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                    Kembali
                </button>
                <button type="button" wire:click="nextStep" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
                    Berikutnya
                </button>
            </div>
        </div>
        @endif

        <!-- Step 4: Alasan dan Kronologi -->
        @if($step == 4)
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Alasan dan Kronologi</h2>
            
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alasan Pemberian</label>
                    <textarea wire:model="alasan_pemberian" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('alasan_pemberian') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kronologi Penerimaan</label>
                    <textarea wire:model="kronologi_penerimaan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('kronologi_penerimaan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Link Dokumen Yang Dilampirkan</label>
                    <input type="url" wire:model="link_dokumen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="https://...">
                    @error('link_dokumen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upload Dokumen (Opsional)</label>
                    <input type="file" wire:model="dokumen" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('dokumen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Catatan Tambahan (Bila Perlu)</label>
                    <textarea wire:model="catatan_tambahan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('catatan_tambahan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="bersedia_kompensasi" wire:model="bersedia_kompensasi" type="checkbox" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="bersedia_kompensasi" class="font-medium text-gray-700">Pelapor gratifikasi bersedia untuk menyerahkan uang sebagai kompensasi atas barang yang diterimanya sebesar nilai yang tercantum dalam Surat Keputusan Pimpinan KPK</label>
                    </div>
                </div>
                @error('bersedia_kompensasi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="flex justify-between mt-6">
                <button type="button" wire:click="previousStep" class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                    Kembali
                </button>
                <button type="submit" class="ml-auto bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold block">
                    Kirim Laporan
                </button>
            </div>
        </div>
        @endif
    </form>
</div>