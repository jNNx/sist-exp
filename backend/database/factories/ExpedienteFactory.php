<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Expediente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpedienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expediente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nro_expediente' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'fojas' => $this->faker->numberBetween(10, 1000),
            'fecha' => $this->faker->date(),
            'area_actual_id' =>  $this->faker->numberBetween(1, 20),
            //'area_actual_type' => $this->faker->randomElement(['App\Models\Area','App\Models\SubArea']),
            'monto' => $this->faker->numberBetween(1000, 9999),
            'prioridad_id' => $this->faker->numberBetween(1, 2),
            'estado_expediente_id' => $this->faker->numberBetween(1, 2),
            'tipo_expediente' => $this->faker->numberBetween(1, 5) 
        ];
    }
}
