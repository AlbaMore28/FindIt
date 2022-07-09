<?php

namespace Database\Factories;
use App\Models\User;
use Xvladqt\Faker\LoremFlickrProvider;
use Illuminate\Support\Collection;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    public function __construct($count = null,
                                ?Collection $states = null,
                                ?Collection $has = null,
                                ?Collection $for = null,
                                ?Collection $afterMaking = null,
                                ?Collection $afterCreating = null,
                                $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->faker->addProvider(new LoremFlickrProvider($this->faker));
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //'url' => 'users/' . $this->faker->image('public/storage/users', 640, 480, null, false)
        ];
    }

    public function url($where, $keyword){
        return $this->state(function ($attributes) use ($where, $keyword){
            return [
                'url' => $where . $this->faker->image('public/storage/' . $where, 640, 480, $keyword, false)
            ];
        });
    }
}
