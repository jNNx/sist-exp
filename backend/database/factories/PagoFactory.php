<?php

namespace Database\Factories;

use App\Models\Pago;
use App\Models\Expediente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pago::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expediente_id' => Expediente::factory(),
            'nro' => $this->faker->numberBetween(1000, 9999),
            'tipo' => $this->faker->numberBetween(0, 3),
            'estado' => $this->faker->numberBetween(0, 3),
            'fecha'  => $this->faker->date(),
            'monto' => $this->faker->numberBetween(0, 10000)
            ];
    }
}
