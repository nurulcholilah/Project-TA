<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $pegawai = User::create([
            'name' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $pegawai->assignRole('pegawai');
    }
}
