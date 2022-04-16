<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = '[{"nisn":"0023095252","name":"Al Manda Nuzul Ramadhan","gender":"pria","place_of_birth":"Karang Rejo","date_of_birth":"20 November 2002","religion":"Islam","address":"Dusun Cikal Bakal","rombongan_belajar":"XI TP"},{"nisn":"0027496141","name":"M. Rizal","gender":"pria","place_of_birth":"Hinai Kiri","date_of_birth":"25 Oktober 2002","religion":"Islam","address":"Lingkungan II Hinai Kiri","rombongan_belajar":"XI TP"},{"nisn":"0036097149","name":"Mhd. Faujul","gender":"pria","place_of_birth":"Paya Kangkung","date_of_birth":"24 April 2003","religion":"Islam","address":"Dusun IV Paya Kangkung","rombongan_belajar":"XI TP"},{"nisn":"0019382393","name":"Suwarno","gender":"pria","place_of_birth":"PAYA PINANG","date_of_birth":"06 Agustus 2001","religion":"Islam","address":"DUSUN PAYA PINANG","rombongan_belajar":"XII TP"},{"nisn":"0035838587","name":"Bagus Satria","gender":"pria","place_of_birth":"Stabat Lama","date_of_birth":"12 April 2003","religion":"Islam","address":"Dusun Mekar Jaya","rombongan_belajar":"XI TP"},{"nisn":"0032919070","name":"Boy Sadewo","gender":"pria","place_of_birth":"PAYA RENGAS","date_of_birth":"19 Maret 2004","religion":"Islam","address":"LORONG TENGAH","rombongan_belajar":"XI TP"},{"nisn":"0026009718","name":"Dandi","gender":"pria","place_of_birth":"PERDAMAIAN","date_of_birth":"18 April 2002","religion":"Islam","address":"JL SUDAMA","rombongan_belajar":"XI TP"},{"nisn":"0031198645","name":"Dimas Dayu Wenanda","gender":"pria","place_of_birth":"Tandam Hilir I","date_of_birth":"22 Juni 2003","religion":"Islam","address":"Psr. II","rombongan_belajar":"XI TP"},{"nisn":"0022659151","name":"Hamdan Sarkawi","gender":"pria","place_of_birth":"Hinai Kanan","date_of_birth":"18 Juni 2002","religion":"Islam","address":"Jln.Muda Dusun II","rombongan_belajar":"XI TP"},{"nisn":"0032858850","name":"M. Aditya Putra Rangga","gender":"pria","place_of_birth":"PANTAI GEMI","date_of_birth":"14 Mei 2003","religion":"Islam","address":"PANTAI GEMI DUSUN 3","rombongan_belajar":"XI TP"},{"nisn":"0017741352","name":"Hidayat","gender":"pria","place_of_birth":"BINJAI","date_of_birth":"08 Desember 2001","religion":"Islam","address":"DUSUN III KAYU LIMA","rombongan_belajar":"XI TP"},{"nisn":"0036433731","name":"Fariz Rakin","gender":"pria","place_of_birth":"Sibolangit","date_of_birth":"27 April 2004","religion":"Islam","address":"Suka Makmur","rombongan_belajar":"XI TP"},{"nisn":"0035894642","name":"Algy Martan","gender":"pria","place_of_birth":"Gohor Lama","date_of_birth":"09 Agustus 2003","religion":"Islam","address":"Dusun B VII","rombongan_belajar":"XI TP"},{"nisn":"0032915032","name":"Irvan Efendi","gender":"pria","place_of_birth":"Kp. Baru","date_of_birth":"12 Juli 2003","religion":"Islam","address":"Gunung Agung","rombongan_belajar":"XI TP"},{"nisn":"0033883856","name":"Arif Kudadiri","gender":"pria","place_of_birth":"Bekulap","date_of_birth":"24 Desember 2003","religion":"Islam","address":"Dudun Tanjung Anom","rombongan_belajar":"XI TP"},{"nisn":"0032858875","name":"Dimas Farizal Mukti","gender":"pria","place_of_birth":"MEDAN","date_of_birth":"21 Oktober 2003","religion":"Islam","address":"Jl. SUTOYO LINGK.III","rombongan_belajar":"XI TP"},{"nisn":"0032858866","name":"Krisna Primadi Sitepu","gender":"pria","place_of_birth":"SIDOMULYO","date_of_birth":"23 Agustus 2003","religion":"Islam","address":"JL. MESJID","rombongan_belajar":"XI TP"},{"nisn":"0025936649","name":"Mhd. Fahmi","gender":"pria","place_of_birth":"Stabat","date_of_birth":"18 Desember 2002","religion":"Islam","address":"Dusun Pantai Luas","rombongan_belajar":"XI TP"},{"nisn":"0031954836","name":"Azwan Arianto","gender":"pria","place_of_birth":"KWALA BEGUMIT","date_of_birth":"14 Agustus 2003","religion":"Islam","address":"PANTAI PAKAM","rombongan_belajar":"XI TP"},{"nisn":"0019366129","name":"Buhari Efendi","gender":"pria","place_of_birth":"Pasar Batu","date_of_birth":"14 Agustus 2001","religion":"Islam","address":"Dusun Pasar Batu","rombongan_belajar":"XI TP"}]';

        Student::insertOrIgnore(json_decode($json, true));
    }
}
