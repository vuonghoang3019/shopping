<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin','display_name' => 'Quan tri he thong'],
            ['name' => 'guest','display_name' => 'Khach hang'],
            ['name' => 'Dev','display_name' => 'Phat trien he thong'],
            ['name' => 'content','display_name' => 'Chinh sua noi dung'],
        ]);
    }
}
