<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dni' => $this->generateDNI(),
            'name' => $this->faker->name,
        ];
    }

    private function generateDNI()
    {
        $digits = '1234567890';
        $dni = '';
        for ($i = 0; $i < 10; $i++) {
            $dni .= $digits[rand(0, strlen($digits) - 1)];
        }

        return $dni;
    }
}
