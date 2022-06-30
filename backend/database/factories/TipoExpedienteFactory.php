<?php

namespace Database\Factories;

use App\Models\TipoExpediente;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoExpedienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoExpediente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nro_tipo_expediente' => $this->faker->numberBetween(1, 5), 
            'descripcion' => $this->faker->sentence(2),
        ];
    }
}
