<?php

namespace Database\Seeders;

use App\Models\SchoolProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolProfile::truncate();
        SchoolProfile::create([
            "name"  => "SMK Negeri 1 Stabat",
            "address" => "Jl. K.H Wahid Hasyim Kec. Stabat Kab. Langkat POS.20814",
            "postal_number" => "20814",
            "email" => "smknsatustabat@gmail.com",
            "phone_number" => "(061)-8911004",
            "logo" => "school-profile-images/default-logo.png",
            "kepala_sekolah" => "Ilyas, S.Pd, M.PSi",
            "kepala_sekolah_image" => "school-profile-images/default-kepsek.jpg",
            "kata_sambutan" => "Puji Syukur Kita Panjatkan Kehadirat Allah Yang Maha Esa, Karena Atas Limpahan Rahmatnya Serta Inayahnya Kita Semua Bisa Berkumpul Bersama Untuk Menghadiri Acara Ini Dalam Keadaan Sehat Dan Tak Kurang Satu Apapun.\nSholawat Serta Salam Semoga Tetap Tercurah Limpahkan Kepada Junjungan Kita Nabi Besar Mehammad SAW, Beliau Adalah Penyelamat Dunia Dan Yang Telah Membimbing Kita Dari Zaman Yang Biadab Menuju Zaman Yang Beradap.",
        ]);
    }
}
