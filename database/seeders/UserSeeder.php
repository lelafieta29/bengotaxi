<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'nome' => 'Lela Fieta',
                'email' => 'lelafieta@gmail.com',
                'perfil' => 'passageiro',
                'telefone' => '931225614',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // password
                'remember_token' => Str::random(10)
            ]
        );

        User::create(
            [
                'nome' => 'Jesse Lingard',
                'email' => 'lingard@gmail.com',
                'perfil' => 'motorista',
                'telefone' => '931221919',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // password
                'remember_token' => Str::random(10)
            ]
        );

        User::create(
            [
                'nome' => 'John Daniel',
                'email' => 'john@gmail.com',
                'perfil' => 'admin_empresa',
                'telefone' => '922221919',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // password
                'remember_token' => Str::random(10)
            ]
        );
    }
}
