<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->insert([
            'username' => 'akmp',
            'password' => Hash::make('testestes'),
            'nama_admin'=> 'M. Razzaq A',
            'email' => 'admin@gmail.com',
            'no_telp' => '08123456789',
        ]);
    }
}
