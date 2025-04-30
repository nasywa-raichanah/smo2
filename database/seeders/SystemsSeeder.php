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
            ['title' => 'venue_name', 'description' => 'Sritex Arena',],
            ['title' => 'venue_address', 'description' => 'Jl. Abiyoso No.21, Sriwedari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57141',],
            ['title' => 'venue_embed', 'description' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15820.145304311149!2d110.8149706!3d-7.5710187!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x85dcbed76ede6c1c!2sGOR%20Sritex%20Arena!5e0!3m2!1sen!2sid!4v1646472582118!5m2!1sen!2sid',],
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
            ['title' => 'event_name', 'description' => 'Sebelas Maret Cup XII',],
            ['title' => 'event_short_name', 'description' => 'SMC XII',],
            ['title' => 'event_big_logo', 'description' => 'big-logo.png',],
            ['title' => 'event_sm_logo', 'description' => 'sm-logo.png',],
            ['title' => 'home_bg', 'description' => 'hero-bg.jpg',],
            ['title' => 'home_desc', 'description' => '17-19 March, Sritex Arena, Surakarta',],
            ['title' => 'home_yt_teaser', 'description' => 'https://www.youtube.com/watch?v=F3TBZ0i3eFU',],
            ['title' => 'proposal_link', 'description' => 'http://bit.ly/ProposalSEMAROpen2021',],
            ['title' => 'about_desc', 'description' => 'Kejuaraan Karate Antarmahasiswa Sebelas Maret Cup (SMC) adalah salah satu kejuaraan yang diselenggarakan oleh Unit Kegiatan Mahasiswa Institut Karate-Do Indonesia (INKAI) Universitas Sebelas Maret Surakarta.',],
            ['title' => 'date_day', 'description' => 'Friday to Sunday',],
            ['title' => 'date_date', 'description' => '17-19 March',],
            ['title' => 'date_year', 'description' => '2023',],
            ['title' => 'contact_name', 'description' => 'ORMAWA INKAI UNS',],
            ['title' => 'contact_desc', 'description' => 'Kejuaraan Karate Antarmahasiswa Sebelas Maret Cup (SMC) adalah salah satu kejuaraan yang diselenggarakan oleh Unit Kegiatan Mahasiswa Institut Karate-Do Indonesia (INKAI) Universitas Sebelas Maret Surakarta. Kejuaraan ini merupakan kegiatan dua tahunan yang telah dilaksanakan selama <b>20 tahun</b>, yaitu 2 kali kejuaraan se-Jawa Bali, 6 kali Kejuaraan Nasional, dan 2 kali Kejuaraan se-Asia Tenggara. Kejuaraan ini merupakan wadah untuk mengembangkan potensi – potensi mahasiswa dalam meraih prestasi, khususnya di bidang bela diri karate.<br>
            Kejuaraan Karate Antarmahasiswa Sebelas Maret Cup merupakan sarana pengembangan prestasi dan sebagai tolak ukur dalam menilai perkembangan teknik– teknik bela diri karate di Indonesia. Penyelenggaraan kejuaraan ini menjadi momentum untuk memacu prestasi para atlet agar lebih maju sehingga menjadi lebih baik. Perlu diketahui bahwa Kejuaraan Sebelas Maret Cup ini merupakan satu-satunya kejuaraan di Indonesia yang diselenggarakan oleh mahasiswa dan untuk mahasiswa sehingga menjadikan ciri khas dari kejuaraan ini.',],
            ['title' => 'contact_address', 'description' => 'Grha ORMAWA II Lt 2 UNS, Jl. Ir. Sutami 36A, Kentingan, Jebres, Surakarta, Jawa Tengah 57126',],
            ['title' => 'contact_phone', 'description' => '+62812345678',],
            ['title' => 'contact_email', 'description' => 'semarcup@gmail.com',],
            ['title' => 'contact_fb', 'description' => 'https://www.facebook.com/ukminkaiuns',],
            ['title' => 'contact_ig', 'description' => 'https://instagram.com/semarcup',],
            ['title' => 'contact_tw', 'description' => 'https://twitter.com/semarcup',],
            ['title' => 'contact_wa', 'description' => 'https://wa.me/62812345678',],
            ['title' => 'contact_yt', 'description' => 'https://youtube.com/semarcup',],
            ['title' => 'countdown', 'description' => '2023-03-17 08:00:00',],
        ]);
    }
}
