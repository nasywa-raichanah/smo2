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
                'title' => 'How to Register SMO II',
                'message' => 'Steps to register can be seen on the following link <br><a href="http://bit.ly/smcxii"> http://bit.ly/smcxii</a>.',
                'created_at' => Carbon::now()
            ],
            [
                'user_id' => '0',
                'title' => 'Championship Proposal is Now Available',
                'message' => 'Sebelas Maret Open Proposal can be downloaded at <a href="http://bit.ly/smcxii"> http://bit.ly/smcxii</a>.',
                'created_at' => Carbon::now()
            ],
            [
                'user_id' => '0',
                'title' => 'Confirmation of the Date and Place SMO II',
                'message' => 'Sebelas Maret Open II will be scheduled on 24-26 Oktober 2025 at GOR FKOR UNS, Surakarta.',
                'created_at' => Carbon::now()
            ],

        ]);
    }
}
