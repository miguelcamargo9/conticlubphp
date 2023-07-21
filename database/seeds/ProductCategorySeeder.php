<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Vivenciales', 'path' => 'vivenciales'],
            ['name' => 'Hogar', 'path' => 'hogar'],
            ['name' => 'Tecnología', 'path' => 'tecnologia'],
            ['name' => 'Regalos y Deportes', 'path' => 'regalos_deportes'],
        ];

        DB::table('product_categories')->insert($categories);
    }
}
