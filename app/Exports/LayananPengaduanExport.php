<?php

namespace App\Exports;

use App\Models\LayananPengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;

class LayananPengaduanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LayananPengaduan::all();
    }
}
