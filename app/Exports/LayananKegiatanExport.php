<?php

namespace App\Exports;

use App\Models\LayananKegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LayananKegiatanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LayananKegiatan::all();
    }
}
