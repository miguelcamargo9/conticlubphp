<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'password' => bcrypt('1234'),
            'email' => 'admin@admin.com',
            'identification_number' => '1015426224',
            'identification_type' => 'C.C',
            'state' => 1,
            'points' => 0,
            'profiles_id' => 1,
            'subsidiary_id' => 1,
        ]);
    }
}
