<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::insert([
            [
                'title' => 'UNS Gelar Kejuaraan Karate Virtual Championship Sebelas Maret Open 2021',
                'slug' => Str::random(7),
                'excerpt' => 'UNS : Kejuaraan Karate Antar Mahasiswa Tingkat Internasional...',
                'image' => 'uns_semarcup.jpeg',
                'content' => '<div><a href="https://uns.ac.id/id/uns-update/kejuaraan-karate-antar-mahasiswa-tingkat-internasional-sebelas-maret-cup-xii-siap-digelar.html">Universitas Sebelas Maret</a> : Kejuraan Karate antar mahasiswa tingkat internasional “Sebelas Maret Cup XII” siap digelar pada Jumat (17/3/2023) hingga Minggu (19/3/2023). Agenda tersebut dalam rangka memperingati Dies Natalis ke-47 Universitas Sebelas Maret (UNS) Surakarta. Di tahun ini, lokasi pertandingannya bertempat di Gedung Olah Raga (GOR) Fakultas Keolahragaan (FKOR) UNS, beralamat di  Jalan Menteri Supeno, Manahan, Banjarsari, Surakarta.</br></br>Event ini diadakan oleh Organisasi Mahasiswa (Ormawa) Institut Karate-Do Indonesia (INKAI) UNS. Kejuaraan Karate ini menjadi salah satu program kerja Ormawa INKAI UNS. Kejuaraan ini juga merupakan sarana pengembangan prestasi dan sebagai tolak ukur menilai perkembangan teknik karate di kancah Internasional, khususnya di kalangan mahasiswa.</br></br>Dalam konferensi pers pada Kamis (16/3/2023) petang, di Student Center UNS, Ketua Pelaksana Sebelas Maret Cup XII, Ied Fajar Heryan, menjelaskan bahwa event ini pertama digelar sejak tahun 1999 dan menjadi agenda rutinan. “Kami sudah merintis kejuaraan ini sebagai kejuaraan tingkat mahasiswa. Awalnya, hanya tingkat Jawa – Bali, kemudian periode setelahnya merambah tingkat nasional, 3 periode terakhir ini internasional”, tuturnya.</br></br>Saat ditanya uns.ac.id terkait jumlah dan asal peserta, Fajar menyebut bahwa total yang telah terdaftar sebanyak 380 atlet. “Total peserta itu dari 2 negara, Indonesia dan Brunei Darussalam. Total 45 kontingen yang berasal dari berbagai perguruan tinggi di Indonesia dan Brunei Darussalam,” ungkapnya.</br></br>Sementara itu, Ketua Ormawa INKAI UNS, Fatih Raihan Ihwan, menyampaikan bahwa ada 2 kategori atau jenis pertandingan dalam Sebelas Maret Cup XII ini. “Ada Kata dan Kumite. Kata mempertandingkan jurus-jurus karate keindahan, teknik dan atletik. Sementara Kumite merupakan sebuah jenis pertandingan yang mempertemukan antar karakteka dalam pertarungan,” jelasnya.</br></br>Baik kategori Kata maupun Kumite, terbagi menjadi beregu putra dan putri serta perorangan putra dan putri. Penghargaannya terbagi dari Juara Umum 1,2 dan 3; Juara Perorangan 1,2, dan 3; Juara Beregu 1,2, dan 3; serta Juara Best of the Best Putra dan Putri. Selain itu, setiap kontingen dan peserta akan mendapatkan piagam penghargaan peserta kejuaraan dari panitia. Humas UNS</br></br>Berikut rincian jadwal pelaksaksanaan Sebelas Maret Cup XII:</br>Pembukaan: Jumat, 17 Maret 2023 (pukul 13.00 WIB s.d selesai), di GOR Fakultas Keolahragaan UNS, Jl. Menteri Supeno, Manahan, Banjarsari, Surakarta</br>Pertandingan: Jumat (17/3/2023) hingga Minggu (19/3/2023)</br>(Jumat & Sabtu: 08.00 – 20.00 WIB | Minggu: 08.00 – 16.00 WIB), di GOR Fakultas Keolahragaan UNS, Jl. Menteri Supeno, Manahan, Banjarsari, Surakarta</br>Penutupan: Minggu, 19 Maret 2023 (16.00 WIB – selesai), di GOR Fakultas Keolahragaan UNS, Jl. Menteri Supeno, Manahan, Banjarsari, Surakarta</div>',
                'author' => "UNS",
                'created_at' => '2023-03-17 13:47:00',
                'updated_at' => '2023-03-17 13:47:00',
            ],
            [
                'title' => 'UNS Gelar Kejuaraan Karate Virtual Championship Sebelas Maret Open 2021',
                'slug' => Str::random(7),
                'excerpt' => 'UNS : Kejuaraan Karate Antar Mahasiswa Tingkat Internasional...',
                'image' => 'uns_semarcup.jpeg',
                'content' => '<div><a href="https://uns.ac.id/id/uns-update/kejuaraan-karate-antar-mahasiswa-tingkat-internasional-sebelas-maret-cup-xii-siap-digelar.html">buat berita</a> : isi berita</br></br></div>',
                'author' => "UNS",
                'created_at' => '2023-03-17 13:47:00',
                'updated_at' => '2023-03-17 13:47:00',
            ],
        ]);
    }
}
