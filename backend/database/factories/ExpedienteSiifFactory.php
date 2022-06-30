<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpedienteSiifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_actual_id' => $this->faker->numberBetween(1, 25),
            'nro_expediente_ext' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'fojas' => $this->faker->numberBetween(1, 1000),
            'fecha' => $this->faker->date(),
            'descripcion' => $this->faker->sentence(20),
            'nombre' => $this->faker->name(),
            'apellido' => $this->faker->lastname(),
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'cuit' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'cuil' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'telefono' => $this->faker->numberBetween(1000000000, 9999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->sentence(2),
            'area_reparticiones' => $this->faker->numberBetween(1, 5)
        ];
    }
}
