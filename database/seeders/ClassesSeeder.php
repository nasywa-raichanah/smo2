<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classes::insert([
            [
                'type' => '0',
                'class_name' => 'Individual Male Kata',
                'sex' => '0',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '0',
                'class_name' => 'Individual Female Kata',
                'sex' => '1',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '1',
                'class_name' => 'Team Male Kata',
                'sex' => '0',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '3',
                'max_athlete' => '3',
            ],
            [
                'type' => '1',
                'class_name' => 'Team Female Kata',
                'sex' => '1',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '3',
                'max_athlete' => '3',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite -55kg',
                'sex' => '0',
                'min_weight' => '1',
                'max_weight' => '55',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite -60kg',
                'sex' => '0',
                'min_weight' => '56',
                'max_weight' => '60',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite -67kg',
                'sex' => '0',
                'min_weight' => '61',
                'max_weight' => '67',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite -75kg',
                'sex' => '0',
                'min_weight' => '68',
                'max_weight' => '75',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite -84kg',
                'sex' => '0',
                'min_weight' => '76',
                'max_weight' => '84',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Male Kumite +84kg',
                'sex' => '0',
                'min_weight' => '84',
                'max_weight' => '150',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Female Kumite -50kg',
                'sex' => '1',
                'min_weight' => '1',
                'max_weight' => '50',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Female Kumite -55kg',
                'sex' => '1',
                'min_weight' => '51',
                'max_weight' => '55',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Female Kumite -61kg',
                'sex' => '1',
                'min_weight' => '56',
                'max_weight' => '61',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Female Kumite -68kg',
                'sex' => '1',
                'min_weight' => '62',
                'max_weight' => '68',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '2',
                'class_name' => 'Individual Female Kumite +68kg',
                'sex' => '1',
                'min_weight' => '68',
                'max_weight' => '150',
                'min_athlete' => '1',
                'max_athlete' => '1',
            ],
            [
                'type' => '3',
                'class_name' => 'Team Male Kumite',
                'sex' => '0',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '5',
                'max_athlete' => '7',
            ],
            [
                'type' => '3',
                'class_name' => 'Team Female Kumite',
                'sex' => '1',
                'min_weight' => '0',
                'max_weight' => '0',
                'min_athlete' => '5',
                'max_athlete' => '7',
            ],
        ]);
    }
}
