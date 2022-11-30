<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClienteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cliente::all();
    }

    public function columnFormats(): array
    {
        return [
            'ruc' => NumberFormat::TYPE_NUMERIC,
            'telefono' => NumberFormat::TYPE_NUMERIC,
       
        ];
    }
     

}
