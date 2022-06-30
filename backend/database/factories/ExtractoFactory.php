<?php

namespace Database\Factories;

use App\Models\Extracto;
use App\Models\TipoExpediente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtractoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extracto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => $this->faker->sentence(2),
            //'tipo_expediente' => TipoExpediente::factory()
        ];
    }
}
