<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Managers;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                'role' => 'Admin',
                'username' => 'Admin',
                'university' => 'Admin',
                'email' => 'smo2@gmail.com',
                'password' => bcrypt('esemodua'),
                'is_active' => 1,
                'is_confirm' => 0,
            ]
        );
        Managers::insert(
            [
                'user_id' => null,
                'manager_name' => 'Not Yet',
                'coach_photo' => 'not-available.png',
                // 'coach_num' => '-'
            ]
        );
        $this->call(SystemsSeeder::class);
        $this->call(CountriesSeeder::class);

        // aktifkan seed dibawah untuk dummy
        $this->call(UsersSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(ManagersSeeder::class);
        $this->call(AthletesSeeder::class);
        $this->call(InvoicesSeeder::class);
        $this->call(PaymentsSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(MessagesSeeder::class);
    }
}
