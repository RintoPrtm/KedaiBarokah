<?php

namespace Database\Seeders;

use App\Models\Warung;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarungSeeder extends Seeder
{
    public function run(): void
    {
        Warung::truncate();
        
        db::table('warung')->insert([
            [
                'nama_warung' => 'Kedai Barokah Jl M',
                'alamat_warung' => 'Jl. Cipinang Muara Raya 14-16, RT.16/RW.3, Cipinang Muara, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13420',
                'foto_warung' => 'warung1.jpg',
                'deskripsi_warung' => 'Warung Barokah adalah warung makan yang terletak di Kelurahan Cipinang Muara, Jakarta Timur, yang telah melayani masyarakat dengan masakan tradisional sejak tahun 2016. Dengan cita rasa yang khas dan kualitas yang terjaga, Kedai Berkah telah menjadi pilihan favorit bagi pelanggan lokal.',
            ]
        ]);
    }
}
