<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Producto::all();
    }

  /*   public function columnFormats(): array
    {
        return [
            'ruc' => NumberFormat::TYPE_NUMERIC,
            'telefono' => NumberFormat::TYPE_NUMERIC,
       
        ];
    }
     */ 

}
