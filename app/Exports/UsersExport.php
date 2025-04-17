<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ProExcel;

use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProExcel::all();
    }
}

