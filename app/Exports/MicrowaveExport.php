<?php

namespace App\Exports;

use App\Microwave;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class MicrowaveExport implements FromCollection {
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection() {

        return Microwave::all();

    }
}
