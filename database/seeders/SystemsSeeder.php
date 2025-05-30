<?php

namespace Database\Seeders;

use App\Models\Systems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Systems::insert([
            // venue
            ['title' => 'venue_name', 'description' => 'GOR FKOR UNS',],
            ['title' => 'venue_address', 'description' => 'Jl. Menteri Supeno No.6, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139',],
            ['title' => 'venue_embed', 'description' => 'https://maps.google.com/maps?q=gor+fkor+uns&output=embed',],
            ['title' => 'venue_img1', 'description' => 'venue_img1.jpg',],
            ['title' => 'venue_img2', 'description' => 'venue_img2.jpg',],
            ['title' => 'venue_img3', 'description' => 'venue_img3.jpg',],
            ['title' => 'venue_img4', 'description' => 'venue_img4.jpg',],
            // galleries
            ['title' => 'galleries_img1', 'description' => 'galleries_img1.jpg',],
            ['title' => 'galleries_img2', 'description' => 'galleries_img2.jpg',],
            ['title' => 'galleries_img3', 'description' => 'galleries_img3.jpg',],
            ['title' => 'galleries_img4', 'description' => 'galleries_img4.jpg',],
            ['title' => 'galleries_img5', 'description' => 'galleries_img5.jpg',],
            ['title' => 'galleries_img6', 'description' => 'galleries_img6.jpg',],
            ['title' => 'galleries_img7', 'description' => 'galleries_img7.jpg',],
            ['title' => 'galleries_img8', 'description' => 'galleries_img8.jpg',],
            //transactions
            ['title' => 'regist_cost', 'description' => '350000',],
            ['title' => 'ind_kata_cost', 'description' => '225000',],
            ['title' => 'ind_kumite_cost', 'description' => '225000',],
            ['title' => 'team_kata_cost', 'description' => '275000',],
            ['title' => 'team_kumite_cost', 'description' => '275000',],
            ['title' => 'bank_logo', 'description' => 'bank.png',],
            ['title' => 'bank_name', 'description' => 'BANK BRI',],
            ['title' => 'bank_number', 'description' => '6704-1212-121-9-12',],
            ['title' => 'bank_name_of', 'description' => 'Himawan Addillah',],
            ['title' => 'trans_confirm_contact', 'description' => '62856123456',],
            //systems
            ['title' => 'event_name', 'description' => 'Sebelas Maret Open II',],
            ['title' => 'event_short_name', 'description' => 'SMO II',],
            ['title' => 'event_big_logo', 'description' => 'logo_panjang.png',],
            ['title' => 'event_sm_logo', 'description' => 'logo_icon.png',],
            ['title' => 'home_bg', 'description' => 'hero-bg.jpg',],
            ['title' => 'home_desc', 'description' => '24-26 Oktober, GOR FKOR UNS, Surakarta',],
            ['title' => 'home_yt_teaser', 'description' => 'https://www.youtube.com/watch?v=F3TBZ0i3eFU',],
            ['title' => 'proposal_link', 'description' => 'http://bit.ly/ProposalSEMAROpen2021',],
            ['title' => 'about_desc', 'description' => 'Kejuaraan Karate Sebelas Maret Open II 2025 merupakan kejuaraan yang diselenggarakan oleh Organisasi Mahasiswa Institut Karate-Do Indonesia (INKAI) Universitas Sebelas Maret Surakarta',],
            ['title' => 'date_day', 'description' => 'Friday to Sunday',],
            ['title' => 'date_date', 'description' => '24-26 Oktober',],
            ['title' => 'date_year', 'description' => '2025',],
            ['title' => 'contact_name', 'description' => 'ORMAWA INKAI UNS',],
            ['title' => 'contact_desc', 'description' => 'Kejuaraan Karate Sebelas Maret Open II 2025 merupakan kejuaraan yang diselenggarakan oleh Organisasi Mahasiswa Institut Karate-Do Indonesia (INKAI) Universitas Sebelas Maret Surakarta, sebagai lanjutan dari Kejuaraan Karate Antarmahasiswa Sebelas Maret Cup XII tahun 2023. Kejuaraan ini merupakan kegiatan dua tahunan yang telah berlangsung selama 24 tahun, dengan sejarah penyelenggaraan meliputi 2 kali kejuaraan se-Jawa Bali, 6 kali kejuaraan nasional, 3 kali kejuaraan se-Asia Tenggara, dan 1 kali kejuaraan internasional.</br>Kejuaraan yang akan dilaksanakan pada tahun 2025 ini merupakan kejuaraan tingkat internasional dengan sistem open. Kejuaraan Sebelas Maret Open pertama kali diselenggarakan oleh ORMAWA INKAI UNS pada tahun 2021 secara virtual sebagai bentuk adaptasi terhadap pandemi COVID-19.</br>Kejuaraan ini bertujuan menjadi wadah pengembangan potensi mahasiswa dalam meraih prestasi, khususnya di bidang bela diri karate. Selain itu, Kejuaraan Karate Sebelas Maret Open juga menjadi sarana pengembangan prestasi dan tolak ukur dalam menilai perkembangan teknik-teknik bela diri karate di Indonesia. ',],
            ['title' => 'contact_address', 'description' => 'Grha ORMAWA II Lt 2 UNS, Jl. Ir. Sutami 36A, Kentingan, Jebres, Surakarta, Jawa Tengah 57126',],
            ['title' => 'contact_phone', 'description' => '+6282338834653',],
            ['title' => 'contact_email', 'description' => 'semarcup@gmail.com',],
            ['title' => 'contact_fb', 'description' => 'https://www.facebook.com/ukminkaiuns',],
            ['title' => 'contact_ig', 'description' => 'https://instagram.com/semar_open',],
            ['title' => 'contact_tw', 'description' => 'https://twitter.com/semarcup',],
            ['title' => 'contact_wa', 'description' => 'https://wa.me/6282338834653',],
            ['title' => 'contact_yt', 'description' => 'https://youtube.com/semarcup',],
            ['title' => 'countdown', 'description' => '2025-10-24 08:00:00',],
        ]);
    }
}
