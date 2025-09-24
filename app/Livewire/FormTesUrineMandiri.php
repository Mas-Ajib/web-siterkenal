<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TesUrineMandiri;

class FormTesUrineMandiri extends Component
{
    use WithFileUploads;

    public $jenis_tes;
    public $nama_penyelenggara;
    public $tanggal;
    public $waktu;
    public $tempat;
    public $nama_penanggung_jawab;
    public $nohp_penanggung_jawab;
    public $jumlah_peserta;
    public $keterangan;
    public $lampiran;

    public function submit()
    {
        $this->validate([
            'jenis_tes' => 'required',
            'nama_penyelenggara' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required',
            'nama_penanggung_jawab' => 'required',
            'nohp_penanggung_jawab' => 'required',
            'jumlah_peserta' => 'required|integer',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $lampiranPath = $this->lampiran ? $this->lampiran->store('lampiran_tes_urine', 'public') : null;

        TesUrineMandiri::create([
            'jenis_tes' => $this->jenis_tes,
            'nama_penyelenggara' => $this->nama_penyelenggara,
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
            'tempat' => $this->tempat,
            'nama_penanggung_jawab' => $this->nama_penanggung_jawab,
            'nohp_penanggung_jawab' => $this->nohp_penanggung_jawab,
            'jumlah_peserta' => $this->jumlah_peserta,
            'keterangan' => $this->keterangan,
            'lampiran' => $lampiranPath,
        ]);

        session()->flash('success', 'Formulir Tes Urine Mandiri berhasil dikirim.');
        $this->reset();

        return redirect()->route('confirmation', [
            'title' => 'Konfirmasi Pengisian Formulir Tes Urine Mandiri'
        ]);
    }

    public function render()
    {
        return view('livewire.form-tes-urine-mandiri');
    }
}
