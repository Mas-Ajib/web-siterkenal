<?php

namespace App\Http\Livewire\Pengaduan;

use Livewire\Component;

class Gratifikasi extends Component
{
    public $step = 0;

    public $nama, $nik, $tempat_lahir, $tanggal_lahir, $jabatan, $instansi;
    public $nama_pemberi, $pekerjaan_pemberi, $hubungan, $kontak_pemberi;
    public $alasan, $kronologi, $link_dokumen, $catatan, $bersedia = false;

    public function nextStep()
    {
        if ($this->step < 2) $this->step++;
    }

    public function prevStep()
    {
        if ($this->step > 0) $this->step--;
    }

    public function submit()
    {
        // TODO: Simpan data ke database
        session()->flash('success', 'Laporan gratifikasi berhasil dikirim!');
        $this->reset();
        $this->step = 0;
    }

    public function render()
    {
        return view('livewire.pengaduan.gratifikasi');
    }
}
