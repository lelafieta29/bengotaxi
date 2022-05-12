<?php

namespace Database\Seeders;

use App\Models\Distrito;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distrito::create([
            'nome' => 'Cazenga Distrito 1',
            'municipio_id' => 1
        ]);
        Distrito::create([
            'nome' => 'Cazenga Distrito 2',
            'municipio_id' => 1
        ]);

        Distrito::create([
            'nome' => 'Lorem ipsum',
            'municipio_id' => 2
        ]);
    }
}
