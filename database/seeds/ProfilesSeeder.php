<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ['name' => 'admin'],
            ['name' => 'general'],
            ['name' => 'rueda'],
            ['name' => 'aprobador'],
            ['name' => 'comprador'],
        ];

        DB::table('profiles')->insert($profiles);
    }
}
