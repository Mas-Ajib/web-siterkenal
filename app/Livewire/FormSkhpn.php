<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Skhpn;

class FormSkhpn extends Component
{
    public $nama, $nik, $alamat, $no_hp, $tujuan;

    public function submit()
    {
        $this->validate([
            'nama' => 'required',
            'nik' => 'required|unique:skhpn,nik',
            'alamat' => 'required',
            'no_hp' => 'required',
            'tujuan' => 'required',
        ]);

        Skhpn::create([
            'nama' => $this->nama,
            'nik' => $this->nik,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'tujuan' => $this->tujuan,
        ]);

        session()->flash('success', 'Form SKHPN berhasil dikirim.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form-skhpn')
        ->extends('layouts.app')   // pakai layout utama
        ->section('content');      // isi bagian @yield('content')
    }
}
