<?php

namespace Database\Factories;

use App\Models\Objeto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Objeto>
 */
class ObjetoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoria' =>$this->faker->randomElement(['animal','cartera','ropa','llaves','telefono']),
            'titulo' =>$this->faker->word(10),
            'descripcion' =>$this->faker->text(250),
            'color' =>$this->faker->word(7),
            'lugar'=>$this->faker->text(100),
            'visibilidad' =>$this->faker->randomElement([0,1]),
            'tamanio' =>$this->faker->randomElement(['grande','mediano','pequenio']),
        ];
    }
}
