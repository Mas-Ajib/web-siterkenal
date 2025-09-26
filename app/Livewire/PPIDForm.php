<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PPIDRequest;

class PPIDForm extends Component
{
    public $nama_pemohon;
    public $alamat;
    public $nomor_handphone;
    public $email;
    public $informasi_dibutuhkan;
    public $alasan_meminta;
    public $cara_memperoleh;
    public $cara_mengirim;

    protected $rules = [
        'nama_pemohon' => 'required|string|max:255',
        'alamat' => 'required|string|max:500',
        'nomor_handphone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'informasi_dibutuhkan' => 'required|string|min:10|max:1000',
        'alasan_meminta' => 'required|string|min:10|max:1000',
        'cara_memperoleh' => 'required|string',
        'cara_mengirim' => 'required|string'
    ];

    public function submit()
    {
        $this->validate();

        PPIDRequest::create([
            'nama_pemohon' => $this->nama_pemohon,
            'alamat' => $this->alamat,
            'nomor_handphone' => $this->nomor_handphone,
            'email' => $this->email,
            'informasi_dibutuhkan' => $this->informasi_dibutuhkan,
            'alasan_meminta' => $this->alasan_meminta,
            'cara_memperoleh' => $this->cara_memperoleh,
            'cara_mengirim' => $this->cara_mengirim,
        ]);

        $this->reset();

        session()->flash('success', 'Permohonan informasi PPID berhasil dikirim. Akan diproses dalam 10 hari kerja.');

    }
    public function render()
    {
        return view('livewire.form-ppid-informasi')
            ->layout('layouts.app')
            ->section('content');
    }
}
