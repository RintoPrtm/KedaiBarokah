<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();

        User::insert([
            'username' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'telp_user' => '081234567890',
            'rule' => 'admin',

        ]);

        Schema::enableForeignKeyConstraints();
    }
}
