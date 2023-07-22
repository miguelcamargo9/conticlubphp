<?php

use Illuminate\Database\Seeder;

use Database\Seeders\ProfilesSeeder;
use Database\Seeders\CitiesSeeder;
use Database\Seeders\SubsidiarySeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\ProductCategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\DesignSeeder;
use Database\Seeders\UsersTableSeeder;

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
