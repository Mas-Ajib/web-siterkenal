<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FormMagang extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $email, $instansi, $penanggung_jawab, $no_kontak, $jangka_waktu, $jumlah_peserta, $lampiran;

    protected $rules = [
        'nama_lengkap'     => 'required|string|max:255',
        'email'            => 'nullable|email',
        'instansi'         => 'nullable|string|max:255',
        'penanggung_jawab' => 'nullable|string|max:255',
        'no_kontak'        => 'nullable|string|max:30',
        'jangka_waktu'     => 'nullable|string|max:100',
        'jumlah_peserta'   => 'nullable|integer|min:1',
        'lampiran'         => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ];

    public function submit()
    {
        $data = $this->validate();

        if ($this->lampiran) {
            $data['lampiran'] = $this->lampiran->store('lampiran/magang', 'public');
        }

        // \App\Models\Magang::create($data);

        session()->flash('success', 'Permohonan magang/riset berhasil dikirim.');
        $this->reset(['nama_lengkap','email','instansi','penanggung_jawab','no_kontak','jangka_waktu','jumlah_peserta','lampiran']);
        $this->resetValidation();

        return redirect()->route('confirmation', [
            'title' => 'Konfirmasi Pengisian Formulir Magang'
        ]);
    }

    public function render()
    {
        return view('livewire.form-magang');
    }
}
