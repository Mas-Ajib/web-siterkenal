<?php

namespace App\Livewire\Pengaduan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\GratifikasiReport;

class GratifikasiForm extends Component
{
    use WithFileUploads;
    
    public $step = 1;
    
    // Data Pribadi
    public $nama_lengkap;
    public $nik;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jabatan;
    public $nama_instansi;
    public $unit_kerja;
    public $email;
    public $no_seluler;
    public $no_rumah;
    public $no_kantor;
    public $alamat_kantor;
    public $alamat_pengiriman;
    
    // Data Penerimaan
    public $jenis_penerimaan;
    public $nilai_nominal;
    public $peristiwa_penerimaan;
    public $tempat_penerimaan;
    public $tanggal_penerimaan;
    
    // Data Pemberi
    public $nama_pemberi;
    public $pekerjaan_jabatan_pemberi;
    public $hubungan_dengan_pemberi;
    public $alamat_pemberi;
    public $telepon_pemberi;
    public $fax_pemberi;
    public $email_pemberi;
    
    // Alasan dan Kronologi
    public $alasan_pemberian;
    public $kronologi_penerimaan;
    public $link_dokumen;
    public $catatan_tambahan;
    public $bersedia_kompensasi = false;
    
    // File Upload
    public $dokumen;
    
    protected $rules = [
        // Step 1 rules
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|numeric|digits:16',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jabatan' => 'required|string|max:255',
        'nama_instansi' => 'required|string|max:255',
        'unit_kerja' => 'required|string|max:255',
        'email' => 'required|email',
        'no_seluler' => 'required|numeric',
        'no_rumah' => 'nullable|numeric',
        'no_kantor' => 'nullable|numeric',
        'alamat_kantor' => 'required|string|max:500',
        'alamat_pengiriman' => 'required|string|max:500',
        
        // Step 2 rules
        'jenis_penerimaan' => 'required|string|max:500',
        'nilai_nominal' => 'required|numeric',
        'peristiwa_penerimaan' => 'required|string|max:500',
        'tempat_penerimaan' => 'required|string|max:255',
        'tanggal_penerimaan' => 'required|date',
        
        // Step 3 rules
        'nama_pemberi' => 'required|string|max:255',
        'pekerjaan_jabatan_pemberi' => 'required|string|max:255',
        'hubungan_dengan_pemberi' => 'required|string|max:255',
        'alamat_pemberi' => 'required|string|max:500',
        'telepon_pemberi' => 'nullable|numeric',
        'fax_pemberi' => 'nullable|string|max:255',
        'email_pemberi' => 'nullable|email',
        
        // Step 4 rules
        'alasan_pemberian' => 'required|string|max:1000',
        'kronologi_penerimaan' => 'required|string|max:1000',
        'link_dokumen' => 'nullable|url',
        'catatan_tambahan' => 'nullable|string|max:1000',
        'bersedia_kompensasi' => 'boolean',
        
        // File upload
        'dokumen' => 'nullable|file|max:10240', // Max 10MB
    ];
    
    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'required|numeric|digits:16',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jabatan' => 'required|string|max:255',
                'nama_instansi' => 'required|string|max:255',
                'unit_kerja' => 'required|string|max:255',
                'email' => 'required|email',
                'no_seluler' => 'required|numeric',
                'alamat_kantor' => 'required|string|max:500',
                'alamat_pengiriman' => 'required|string|max:500',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'jenis_penerimaan' => 'required|string|max:500',
                'nilai_nominal' => 'required|numeric',
                'peristiwa_penerimaan' => 'required|string|max:500',
                'tempat_penerimaan' => 'required|string|max:255',
                'tanggal_penerimaan' => 'required|date',
            ]);
        } elseif ($this->step == 3) {
            $this->validate([
                'nama_pemberi' => 'required|string|max:255',
                'pekerjaan_jabatan_pemberi' => 'required|string|max:255',
                'hubungan_dengan_pemberi' => 'required|string|max:255',
                'alamat_pemberi' => 'required|string|max:500',
            ]);
        }
        
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }
    
    public function submit()
    {
        $this->validate();
        
        // Handle file upload
        $dokumenPath = null;
        if ($this->dokumen) {
            $dokumenPath = $this->dokumen->store('dokumen-gratifikasi', 'public');
        }
        
        // Save data to database
        try {
            GratifikasiReport::create([
                'nama_lengkap' => $this->nama_lengkap,
                'nik' => $this->nik,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jabatan' => $this->jabatan,
                'nama_instansi' => $this->nama_instansi,
                'unit_kerja' => $this->unit_kerja,
                'email' => $this->email,
                'no_seluler' => $this->no_seluler,
                'no_rumah' => $this->no_rumah,
                'no_kantor' => $this->no_kantor,
                'alamat_kantor' => $this->alamat_kantor,
                'alamat_pengiriman' => $this->alamat_pengiriman,
                'jenis_penerimaan' => $this->jenis_penerimaan,
                'nilai_nominal' => $this->nilai_nominal,
                'peristiwa_penerimaan' => $this->peristiwa_penerimaan,
                'tempat_penerimaan' => $this->tempat_penerimaan,
                'tanggal_penerimaan' => $this->tanggal_penerimaan,
                'nama_pemberi' => $this->nama_pemberi,
                'pekerjaan_jabatan_pemberi' => $this->pekerjaan_jabatan_pemberi,
                'hubungan_dengan_pemberi' => $this->hubungan_dengan_pemberi,
                'alamat_pemberi' => $this->alamat_pemberi,
                'telepon_pemberi' => $this->telepon_pemberi,
                'fax_pemberi' => $this->fax_pemberi,
                'email_pemberi' => $this->email_pemberi,
                'alasan_pemberian' => $this->alasan_pemberian,
                'kronologi_penerimaan' => $this->kronologi_penerimaan,
                'link_dokumen' => $this->link_dokumen,
                'catatan_tambahan' => $this->catatan_tambahan,
                'bersedia_kompensasi' => $this->bersedia_kompensasi,
                'dokumen_path' => $dokumenPath,
            ]);
            
            // Reset form
            $this->reset();
            
            // Show success message
            session()->flash('message', 'Laporan gratifikasi berhasil dikirim.');
            
            // Redirect or reset step
            $this->step = 1;
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.pengaduan.gratifikasi-form');
    }
}