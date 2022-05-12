<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::create([
            'nome' => 'SSK sksks',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'distrito_id' => 1,
        ]);

        Endereco::create([
            'nome' => 'MMSSK sksks',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'distrito_id' => 2,
        ]);
    }
}
