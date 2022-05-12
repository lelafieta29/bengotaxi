<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create([
            'nome' => 'Luanda',
        ]);
        Provincia::create([
            'nome' => 'Bengo',
        ]);
        Provincia::create([
            'nome' => 'Uige',
        ]);
    }
}
