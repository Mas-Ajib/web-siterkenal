<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sosialisasi;

class FormKegiatanSosialisasi extends Component
{
    use WithFileUploads;

    public $jenis_sosialisasi;
    public $penyelenggara;
    public $tanggal;
    public $waktu;
    public $tempat;
    public $penanggung_jawab;
    public $no_hp;
    public $jumlah_peserta;
    public $keterangan;
    public $lampiran;

    public function submit()
    {
        $this->validate([
            'jenis_sosialisasi' => 'required',
            'penyelenggara' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string',
            'penanggung_jawab' => 'required|string',
            'no_hp' => 'required|string',
            'jumlah_peserta' => 'required|integer',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = $this->lampiran ? $this->lampiran->store('lampiran_sosialisasi', 'public') : null;

        Sosialisasi::create([
            'jenis_sosialisasi' => $this->jenis_sosialisasi,
            'nama_penyelenggara' => $this->penyelenggara,
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
            'tempat' => $this->tempat,
            'nama_penanggung_jawab' => $this->penanggung_jawab,
            'no_hp_penanggung_jawab' => $this->no_hp,
            'jumlah_peserta' => $this->jumlah_peserta,
            'keterangan' => $this->keterangan,
            'lampiran' => $path,
        ]);

        session()->flash('success', 'Data berhasil dikirim!');
        $this->reset();

        return redirect()->route('confirmation', [
            'title' => 'Konfirmasi Pengisian Formulir Kegiatan Sosialisasi'
        ]);
    }

    public function render()
    {
        return view('livewire.form-kegiatan-sosialisasi');
    }
}

