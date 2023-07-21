<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['name' => 'CONTINENTAL'],
            ['name' => 'GENERAL TIRE'],
        ];

        DB::table('brand')->insert($brands);
    }
}
