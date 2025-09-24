<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tat; // model untuk simpan data

class FormTat extends Component
{
    use WithFileUploads;

    public $instansi_pemohon;
    public $nama_tersangka;
    public $tanggal_penangkapan;
    public $jenis_barang_bukti;
    public $berat_barang_bukti;
    public $hasil_urine;
    public $surat_permohonan;

    protected $rules = [
        'instansi_pemohon'   => 'required|string|max:255',
        'nama_tersangka'     => 'required|string|max:255',
        'tanggal_penangkapan'=> 'required|date',
        'jenis_barang_bukti' => 'required|string|max:255',
        'berat_barang_bukti' => 'required|string|max:255',
        'hasil_urine'        => 'required|string|max:255',
        'surat_permohonan'   => 'required|file|mimes:pdf|max:2048',
    ];

    public function submit()
    {
        $this->validate();

        $path = $this->surat_permohonan->store('tat', 'public');

        Tat::create([
            'instansi_pemohon'    => $this->instansi_pemohon,
            'nama_tersangka'      => $this->nama_tersangka,
            'tanggal_penangkapan' => $this->tanggal_penangkapan,
            'jenis_barang_bukti'  => $this->jenis_barang_bukti,
            'berat_barang_bukti'  => $this->berat_barang_bukti,
            'hasil_urine'         => $this->hasil_urine,
            'surat_permohonan'    => $path,
        ]);

        return redirect()->route('confirmation', [
            'title' => 'Konfirmasi Pengisian Formulir TAT'
        ]);

        session()->flash('success', 'Permohonan TAT berhasil dikirim!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form-tat');
    }
}
