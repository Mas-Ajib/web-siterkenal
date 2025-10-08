<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Magang; // pastikan import model Magang

class FormMagang extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $email, $instansi, $penanggung_jawab, $kontak, $jangka_waktu, $jumlah_peserta, $lampiran;

    protected $rules = [
        'nama_lengkap'     => 'required|string|max:255',
        'email'            => 'nullable|email',
        'instansi'         => 'nullable|string|max:255',
        'penanggung_jawab' => 'nullable|string|max:255',
        'kontak'        => 'nullable|string|max:30',
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

        // 🔹 SIMPAN KE DATABASE
        Magang::create([
            'nama_lengkap'     => $this->nama_lengkap,
            'email'            => $this->email,
            'instansi'         => $this->instansi,
            'penanggung_jawab' => $this->penanggung_jawab,
            'kontak'           => $this->kontak, 
            'jangka_waktu'     => $this->jangka_waktu,
            'jumlah_peserta'   => $this->jumlah_peserta,
            'lampiran'         => $data['lampiran'] ?? null,
        ]);

        session()->flash('success', 'Permohonan magang/riset berhasil dikirim.');

        $this->reset(['nama_lengkap','email','instansi','penanggung_jawab','kontak','jangka_waktu','jumlah_peserta','lampiran']);
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
