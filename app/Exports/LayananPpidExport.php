<?php

namespace App\Exports;

use App\Models\LayananPpid;
use Maatwebsite\Excel\Concerns\FromCollection;

class LayananPpidExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LayananPpid::all();
    }
}
