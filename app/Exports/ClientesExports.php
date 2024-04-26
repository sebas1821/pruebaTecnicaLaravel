<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientesExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('clientes')->get();
    }
}
