<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmpresaTransporte;

class EmpresaTransporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmpresaTransporte::create([
            'nome' => 'ANGO-REAL',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
            'user_id' => 3,
        ]);
    }
}
