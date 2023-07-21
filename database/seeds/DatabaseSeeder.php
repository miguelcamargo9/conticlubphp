<?php

use Illuminate\Database\Seeder;

use ProfilesSeeder;
use CitiesSeeder;
use SubsidiarySeeder;
use BrandSeeder;
use ProductCategorySeeder;
use ProductSeeder;
use DesignSeeder;
use UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfilesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(SubsidiarySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DesignSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
