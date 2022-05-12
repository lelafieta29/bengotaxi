<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motorista;

class MotoristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motorista::create([
            'nascimento' => '2001-12-05',
            'user_id' => 2,
            'empresa_transportes_id' => 1,
        ]);
    }
}
