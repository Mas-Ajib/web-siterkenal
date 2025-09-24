<?php

namespace App\Livewire\Pengaduan;

use Livewire\Component;
use App\Models\NarkobaReport;

class NarkobaForm extends Component
{
    public $nama;
    public $telepon;
    public $tempat_kejadian;
    public $keterangan;

    protected $rules = [
        'nama' => 'nullable|string|max:255',
        'telepon' => 'nullable|string|max:20',
        'tempat_kejadian' => 'required|string|max:500',
        'keterangan' => 'required|string|min:10|max:2000'
    ];

    protected $messages = [
        'tempat_kejadian.required' => 'Tempat kejadian harus diisi.',
        'keterangan.required' => 'Keterangan harus diisi.',
        'keterangan.min' => 'Keterangan minimal 10 karakter.'
    ];

    public function submit()
    {
        $this->validate();

        try {
            NarkobaReport::create([
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'tempat_kejadian' => $this->tempat_kejadian,
                'keterangan' => $this->keterangan
            ]);

            // Reset form
            $this->reset();
            
            session()->flash('message', 'Laporan penyalahgunaan narkoba berhasil dikirim. Terima kasih atas partisipasi Anda dalam memberantas narkoba.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengirim laporan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pengaduan.narkoba-form');
    }
}