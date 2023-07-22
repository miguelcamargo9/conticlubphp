<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProfilesSeeder::class,
            CitiesSeeder::class,
            SubsidiarySeeder::class,
            BrandSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            DesignSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
