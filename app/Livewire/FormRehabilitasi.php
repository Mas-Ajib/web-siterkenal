<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rehabilitasi;

class FormRehabilitasi extends Component
{
    public $nama, $alamat, $no_hp, $wali, $riwayat;

    public function submit()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'wali' => 'nullable|string|max:255',
            'riwayat' => 'nullable|string',
        ]);

        Rehabilitasi::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'wali' => $this->wali,
            'riwayat' => $this->riwayat,
        ]);

        session()->flash('success', 'Data berhasil dikirim!');

        return redirect()->to('/rehabilitasi/konfirmasi');
    }

    public function render()
{
    return view('livewire.form-rehabilitasi')
        ->extends('layouts.app')   // pakai layout utama
        ->section('content');      // isi bagian @yield('content')
}
}