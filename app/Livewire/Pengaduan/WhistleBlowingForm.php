<?php

namespace App\Livewire\Pengaduan;

use Livewire\Component;
use App\Models\WhistleBlowingReport;

class WhistleBlowingForm extends Component
{
    public $jenis_pelanggaran;
    public $jenis_pelanggaran_lainnya;
    public $nama_pelapor;
    public $lokasi_kejadian;
    public $kota_kabupaten;
    public $provinsi;
    public $tanggal_kejadian;
    public $waktu_kejadian;
    public $uraian_pengaduan;
    public $email;
    public $pernyataan = false;

    protected $rules = [
        'jenis_pelanggaran' => 'required|string',
        'jenis_pelanggaran_lainnya' => 'nullable|string|max:255',
        'nama_pelapor' => 'nullable|string|max:255',
        'lokasi_kejadian' => 'required|string|max:500',
        'kota_kabupaten' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'tanggal_kejadian' => 'required|date',
        'waktu_kejadian' => 'nullable|date_format:H:i',
        'uraian_pengaduan' => 'required|string|min:10|max:2000',
        'email' => 'nullable|email|max:255',
        'pernyataan' => 'accepted'
    ];

    protected $messages = [
        'jenis_pelanggaran.required' => 'Jenis pelanggaran harus dipilih.',
        'lokasi_kejadian.required' => 'Lokasi kejadian harus diisi.',
        'kota_kabupaten.required' => 'Kota/Kabupaten harus diisi.',
        'provinsi.required' => 'Provinsi harus diisi.',
        'tanggal_kejadian.required' => 'Tanggal kejadian harus diisi.',
        'uraian_pengaduan.required' => 'Uraian pengaduan harus diisi.',
        'uraian_pengaduan.min' => 'Uraian pengaduan minimal 10 karakter.',
        'email.email' => 'Format email tidak valid.',
        'pernyataan.accepted' => 'Anda harus menyetujui pernyataan.'
    ];

    public function submit()
    {
        $this->validate();

        try {
            WhistleBlowingReport::create([
                'jenis_pelanggaran' => $this->jenis_pelanggaran,
                'jenis_pelanggaran_lainnya' => $this->jenis_pelanggaran === 'Lainnya' ? $this->jenis_pelanggaran_lainnya : null,
                'nama_pelapor' => $this->nama_pelapor,
                'lokasi_kejadian' => $this->lokasi_kejadian,
                'kota_kabupaten' => $this->kota_kabupaten,
                'provinsi' => $this->provinsi,
                'tanggal_kejadian' => $this->tanggal_kejadian,
                'waktu_kejadian' => $this->waktu_kejadian,
                'uraian_pengaduan' => $this->uraian_pengaduan,
                'email' => $this->email,
                'pernyataan' => $this->pernyataan
            ]);

            // Reset form
            $this->reset();
            
            session()->flash('message', 'Laporan Whistle Blowing berhasil dikirim. Terima kasih atas partisipasi Anda.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengirim laporan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pengaduan.whistle-blowing-form');
    }
}