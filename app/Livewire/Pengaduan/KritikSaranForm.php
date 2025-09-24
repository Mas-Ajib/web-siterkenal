<?php

namespace App\Livewire\Pengaduan;

use Livewire\Component;
use App\Models\KritikSaranReport;

class KritikSaranForm extends Component
{
    public $nama;
    public $telepon;
    public $kritik;
    public $saran;
    public $pengaduan_layanan;

    protected $rules = [
        'nama' => 'nullable|string|max:255',
        'telepon' => 'nullable|string|max:20',
        'kritik' => 'nullable|string|min:5|max:2000',
        'saran' => 'nullable|string|min:5|max:2000',
        'pengaduan_layanan' => 'nullable|string|min:5|max:2000'
    ];

    protected $messages = [
        'kritik.min' => 'Kritik minimal 5 karakter.',
        'saran.min' => 'Saran minimal 5 karakter.',
        'pengaduan_layanan.min' => 'Pengaduan layanan minimal 5 karakter.'
    ];

    public function submit()
    {
        $this->validate();

        // Validasi bahwa minimal satu dari kritik, saran, atau pengaduan layanan harus diisi
        if (empty($this->kritik) && empty($this->saran) && empty($this->pengaduan_layanan)) {
            session()->flash('error', 'Minimal salah satu dari Kritik, Saran, atau Pengaduan Layanan harus diisi.');
            return;
        }

        try {
            KritikSaranReport::create([
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'kritik' => $this->kritik,
                'saran' => $this->saran,
                'pengaduan_layanan' => $this->pengaduan_layanan
            ]);

            // Reset form
            $this->reset();
            
            session()->flash('message', 'Terima kasih atas Kritik, Saran dan Pengaduan Layanan yang Anda berikan. Masukan Anda sangat berharga bagi kami untuk meningkatkan pelayanan.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengirim data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pengaduan.kritik-saran-form');
    }
}