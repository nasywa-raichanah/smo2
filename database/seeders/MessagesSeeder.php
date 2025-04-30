<?php

namespace Database\Seeders;

use App\Models\Messages;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Messages::insert([
            [
                'user_id' => '0',
                'title' => 'How to Register SMC XII',
                'message' => 'Steps to register can be seen on the following link <br><a href="http://bit.ly/smcxii"> http://bit.ly/smcxii</a>.',
                'created_at' => Carbon::now()
            ],
            [
                'user_id' => '0',
                'title' => 'Championship Proposal is Now Available',
                'message' => 'Sebelas Maret Cup Proposal can be downloaded at <a href="http://bit.ly/smcxii"> http://bit.ly/smcxii</a>.',
                'created_at' => Carbon::now()
            ],
            [
                'user_id' => '0',
                'title' => 'Confirmation of the Date and Place SMC XII',
                'message' => 'Sebelas Maret Cup XII will be scheduled on 17 March 2023 at Sritex Arena, Surakarta.',
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
