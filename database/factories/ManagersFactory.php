<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Managers>
 */
class ManagersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $id = 2;
    public function definition()
    {
        return [
            'user_id' => self::$id++,
            'manager_name' => $this->faker->name(),
            'whatsapp_num' => '62' . random_int(10000000, 9999999999),
            // 'coach_num' => Str::random(10),
            'coach_photo' => 'not-available.png'
        ];
    }
}
