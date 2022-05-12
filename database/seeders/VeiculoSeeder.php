<?php

namespace Database\Seeders;

use App\Models\Veiculo;
use Illuminate\Database\Seeder;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Veiculo::create([
            'nome' => 'Lorem ipsum',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit',
            'cor' => 'verde',
            'placa' => 'AJJ-223',
            'ultima_revisao' => '2022-02-02',
            'ano' => 2000,
            'capacidade' => 5,
            'empresa_transportes_id' => 1,
        ]);
    }
}
