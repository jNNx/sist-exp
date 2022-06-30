<?php

namespace Database\Factories;

use App\Models\Caratula;
use App\Models\Extracto;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\Responsable;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaratulaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Caratula::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expediente_id' => Expediente::factory(),
            'iniciador_id' => $this->faker->numberBetween(1, 47),
            'extracto_id' => Extracto::factory()
        ];
    }
}
