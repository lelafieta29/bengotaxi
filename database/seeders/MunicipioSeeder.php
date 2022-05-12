<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipio::create([
            'nome' => 'Cazenga',
            'provincia_id' => 1
        ]);
        Municipio::create([
            'nome' => 'Cacuaco',
            'provincia_id' => 1
        ]);    
    }
}
