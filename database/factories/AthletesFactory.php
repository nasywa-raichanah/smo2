<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athletes>
 */
class AthletesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sex = random_int(0, 1);
        if ($sex == 0) {
            $gender = 'male';
        } else {
            $gender = 'female';
        }
        $name = $this->faker->name($gender);
        $mail = str_replace(' ', '', $name) . "@" . $this->faker->freeEmailDomain();
        return [
            'user_id' => random_int(2, 16),
            'athlete_name' => $name,
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'sex' => $sex,
            'athlete_email' => $mail,
            'athlete_whatsapp' => '62' . random_int(10000000, 9999999999),
            'weight' => random_int(40, 95),
            'status' => random_int(0, 3),
            'photo' => 'not-available.png',
        ];
    }
}
