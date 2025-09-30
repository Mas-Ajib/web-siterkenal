<?php

namespace App\Exports;

use App\Models\LayananRehabilitasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LayananRehabilitasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LayananRehabilitasi::all();
    }
}
