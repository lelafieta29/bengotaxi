<?php

namespace Database\Seeders;

use App\Models\EmpresaTransporte;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PassageiroSeeder::class,
            EmpresaTransporteSeeder::class,
            MotoristaSeeder::class,
            ProvinciaSeeder::class,
            MunicipioSeeder::class,
            DistritoSeeder::class,
            EnderecoSeeder::class,
            VeiculoSeeder::class,
            ViagemSeeder::class
        ]);
    }
}
