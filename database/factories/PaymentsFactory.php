<?php

namespace Database\Factories;

use App\Models\Invoices;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    /**
     * Create Registration Payments.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    private static $id = 2;
    public function registration()
    {
        return $this->state(function (array $attributes) {
            return [
                'invoices_id' => self::$id - 1,
                'user_id' => self::$id++,
                'item' => 0,
                'qty' => 1,
                'cost' => 100000,
                'total_cost' => 100000,
                // 'status' => random_int(0, 3)
            ];
        });
    }

    /**
     * Create Random Payments.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function random()
    {
        return $this->state(function (array $attributes) {
            $id = random_int(2, 16);
            $qty = random_int(1, 5);
            // $invoice = Invoices::where('id', '=', $id)->first();
            return [
                'invoices_id' => $id - 1,
                'user_id' => $id,
                'item' => random_int(1, 4),
                'qty' => $qty,
                'cost' => 100000,
                'total_cost' => $qty * 100000,
                // 'status' => $invoice->status
            ];
        });
    }
}
