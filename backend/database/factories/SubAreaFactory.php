<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_id' => Area::factory(),
            'descripcion' => $this->faker->sentence(2),
            'admin_subArea' => User::factory(),
        ];
    }
}
