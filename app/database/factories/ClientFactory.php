<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birthday' => $this->faker->dateTimeBetween('1990-01-01', '2021-12-31')->format('d/m/Y'),
            'cpf' => Str::random(3).'.'.Str::random(3).'.'.Str::random(3).'-'.Str::random(2)
        ];
    }
}
