<div class="max-w-5xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-white mb-4">
        PPID (Prosedur Permohonan Informasi di BNN Kabupaten Kendal)
    </h1>

    <div class="bg-white p-6 rounded-lg shadow mb-8 text-justify leading-relaxed">
        <p>Berikut adalah prosedur permohonan informasi terkait tugas dan fungsi kami sebagai instansi pelaksana Pencegahan dan Pemberantasan Penyalahgunaan dan Peredaran Gelap Narkotika:</p>
        <ol class="list-decimal ml-6 space-y-2 mt-3">
            <li>Layanan informasi dikelola secara terpusat oleh Bagian Informasi dan PPID BNN RI.</li>
            <li>Unit layanan diselenggarakan oleh PPID BNN Kabupaten Kendal, alamat: Jalan Gajahmada, Karangsari, Kabupaten Kendal.</li>
            <li>Permohonan dapat disampaikan langsung, via surat ke alamat di atas, email ke <b>bnnkkendal@gmail.com</b>, telp (0294) 388702, faks (0294) 388157.</li>
            <li>Pemohon wajib melampirkan dokumen sesuai ketentuan (KTP, akta notaris, atau akta pendirian).</li>
            <li>Proses 10 hari kerja, dapat ditambah 7 hari kerja dengan pemberitahuan.</li>
            <li>Jadwal pelayanan:
                <ul class="list-disc ml-6">
                    <li>Senin-Kamis: 09.00-12.00 WIB & 13.00-15.00 WIB</li>
                    <li>Jumat: 09.00-11.30 WIB & 13.30-15.00 WIB</li>
                </ul>
            </li>
            <li>Tidak dipungut biaya (biaya copy/duplikasi ditanggung pemohon).</li>
            <li>Info lengkap: <a href="https://ppid.bnn.go.id" target="_blank" class="text-blue-600 underline">ppid.bnn.go.id</a></li>
        </ol>
    </div>

    <h2 class="text-xl font-semibold text-white mb-4">Formulir Permohonan Informasi</h2>

     @if (session()->has('success'))
        <div class="p-3 mb-3 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="bg-white p-6 rounded-lg shadow space-y-4">
        <div>
            <label class="block font-medium">Nama Pemohon Informasi</label>
            <input type="text" wire:model="nama_pemohon" class="w-full border rounded p-2">
            @error('nama_pemohon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Alamat</label>
            <textarea wire:model="alamat" class="w-full border rounded p-2"></textarea>
            @error('alamat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Nomor Handphone (WhatsApp)</label>
            <input type="text" wire:model="nomor_handphone" class="w-full border rounded p-2">
            @error('nomor_handphone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Informasi Yang Dibutuhkan</label>
            <textarea wire:model="informasi_dibutuhkan" class="w-full border rounded p-2"></textarea>
            @error('informasi_dibutuhkan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Alasan Meminta Informasi</label>
            <textarea wire:model="alasan_meminta" class="w-full border rounded p-2"></textarea>
            @error('alasan_meminta') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Cara Memperoleh Informasi</label>
            <select wire:model="cara_memperoleh" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="Melihat/membaca/mendengarkan/mencatat">Melihat/membaca/mendengarkan/mencatat</option>
                <option value="Mendapatkan salinan informasi (Hardcopy/Softcopy)">Mendapatkan Salinan Informasi (Hardcopy/Softcopy)</option>
            </select>
            @error('cara_memperoleh') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Cara Mengirim Informasi</label>
            <select wire:model="cara_mengirim" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                <option value="Diambil Langsung">Diambil Langsung</option>
                <option value="Kurir">Kurir</option>
                <option value="Pos">Pos</option>
                <option value="Email">Email</option>
                <option value="Faksimili">Faksimili</option>
            </select>
            @error('cara_mengirim') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim Permohonan
        </button>
    </form>
</div>
