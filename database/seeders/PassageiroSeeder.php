<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passageiro;

class PassageiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Passageiro::create([
            'nascimento' => '1999-04-11',
            'user_id' => 1
        ]);
    }
}
