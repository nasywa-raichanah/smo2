<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoices>
 */
class InvoicesFactory extends Factory
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
            'user_id' => self::$id,
            'invoice_code' => 'SMC' . str_pad(self::$id++, 4, "0", STR_PAD_LEFT),
            'total' => random_int(5, 15) * 25000,
            'status' => random_int(0, 1)
        ];
    }
}
