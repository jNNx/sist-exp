<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\User;
use App\Models\Historial;
use App\Models\Expediente;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $areaOrigen = Area::factory();
        $areaDestino = Area::factory();
        return [
            'expediente_id'     => '1',  
            'user_id'           => $this->faker->numberBetween(1, 115),
            'area_origen_id'    => $this->faker->numberBetween(1, 25),
            'area_destino_id'   => $this->faker->numberBetween(1, 25),
            'fojas'             => $this->faker->numberBetween(1, 1000),
            'fecha'             => $this->faker->date(),
            'hora'              => $this->faker->time(),
            'estado'            => $this->faker->randomElement([1,3,4,5]),
            'motivo'            => $this->faker->text()
        ];
    }
}
