<?php

namespace Database\Factories;

use App\Models\Passageiro;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()
            ->has(Passageiro::factory()->count(3), 'passageiro')
            ->create();
    }
}
