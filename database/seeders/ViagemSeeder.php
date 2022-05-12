<?php

namespace Database\Seeders;

use App\Models\Viagem;
use Illuminate\Database\Seeder;

class ViagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Viagem::create([
            'tipo_viagem' => 'SSK sksks',
            'situacao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'origem' => 'sed do eiusmod',
            'destino' => 'sed do eiusmod',
            'valor' => 120,
            'motorista_id' => 1,
            'veiculo_id' => 1,
            'hora_inicio' => '10:20',
            'endereco_origem_id' => 1,
            'endereco_destino_id' => 2,
        ]);
        Viagem::create([
            'tipo_viagem' => 'SSK sksks',
            'situacao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'origem' => 'sed do eiusmod',
            'destino' => 'sed do eiusmod',
            'valor' => 220,
            'motorista_id' => 1,
            'veiculo_id' => 1,
            'hora_inicio' => '10:20',
            'endereco_origem_id' => 1,
            'endereco_destino_id' => 2,
        ]);
        Viagem::create([
            'tipo_viagem' => 'SSK sksks',
            'situacao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'origem' => 'sed do eiusmod',
            'destino' => 'sed do eiusmod',
            'valor' => 100,
            'motorista_id' => 1,
            'veiculo_id' => 1,
            'hora_inicio' => '10:20',
            'endereco_origem_id' => 1,
            'endereco_destino_id' => 2,
        ]);
        Viagem::create([
            'tipo_viagem' => 'SSK sksks',
            'situacao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',
            'origem' => 'sed do eiusmod',
            'destino' => 'sed do eiusmod',
            'valor' => 200,
            'motorista_id' => 1,
            'veiculo_id' => 1,
            'hora_inicio' => '10:20',
            'endereco_origem_id' => 1,
            'endereco_destino_id' => 2,
        ]);
    }
}
