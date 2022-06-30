<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'persona_id' => Persona::factory(),
            'cuil' =>  $this->faker->unique()->numberBetween(20000000000, 99999999999),
            'tipo_user_id' => $this->faker->numberBetween(1,2),
            'area_id' => $this->faker->numberBetween(1,37),
            'area_type' => $this->faker->randomElement(['App\Models\SubArea']),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            // 'name' => $this->faker->name(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
