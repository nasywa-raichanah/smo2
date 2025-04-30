<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    private static $id = 2;
    public function definition()
    {
        $state = $this->faker->unique()->state;
        $mail = str_replace(' ', '', $state) . "@" . $this->faker->freeEmailDomain();
        return [
            'manager_id' => self::$id++,
            'role' => 'Participant',
            'username' => $state,
            'university' => 'Universitas ' . $state,
            'email' => $mail,
            'password' => bcrypt('123456'),
            'is_active' => '1',
            'is_confirm' => '1',
            'status' => random_int(0, 3),
            'nationality' => $this->faker->countryCode(),
            'address' => $this->faker->address,
            'postal_code' => random_int(10000, 99999),
            'logo' => 'not-available.png'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
