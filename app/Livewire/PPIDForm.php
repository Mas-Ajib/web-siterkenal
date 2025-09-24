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

    protected $messages = [
        'nama_pemohon.required' => 'Nama pemohon informasi harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
        'nomor_handphone.required' => 'Nomor handphone harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'informasi_dibutuhkan.required' => 'Informasi yang dibutuhkan harus diisi.',
        'informasi_dibutuhkan.min' => 'Informasi yang dibutuhkan minimal 10 karakter.',
        'alasan_meminta.required' => 'Alasan meminta informasi harus diisi.',
        'alasan_meminta.min' => 'Alasan meminta informasi minimal 10 karakter.',
        'cara_memperoleh.required' => 'Cara memperoleh informasi harus dipilih.',
        'cara_mengirim.required' => 'Cara mengirim informasi harus dipilih.'
    ];

    public function submit()
    {
        $this->validate();

        try {
            PPIDRequest::create([
                'nama_pemohon' => $this->nama_pemohon,
                'alamat' => $this->alamat,
                'nomor_handphone' => $this->nomor_handphone,
                'email' => $this->email,
                'informasi_dibutuhkan' => $this->informasi_dibutuhkan,
                'alasan_meminta' => $this->alasan_meminta,
                'cara_memperoleh' => $this->cara_memperoleh,
                'cara_mengirim' => $this->cara_mengirim
            ]);

            // Reset form
            $this->reset();
            
            session()->flash('message', 'Permohonan informasi PPID berhasil dikirim. Permohonan Anda akan diproses dalam waktu 10 hari kerja.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengirim permohonan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pengaduan.ppid-form');
    }
}