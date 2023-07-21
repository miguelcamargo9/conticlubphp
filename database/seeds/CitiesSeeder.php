<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Armenia'],
            ['name' => 'Barranquilla'],
            ['name' => 'Bello'],
            ['name' => 'Bogotá'],
            ['name' => 'Bosconia'],
            ['name' => 'Bucaramanga'],
            ['name' => 'Cali'],
            ['name' => 'Cartagena'],
            ['name' => 'Cartago'],
            ['name' => 'Chia'],
            ['name' => 'Dos Quebradas'],
            ['name' => 'Duitama'],
            ['name' => 'Facatativa'],
            ['name' => 'Fusagasuga'],
            ['name' => 'Girardot'],
            ['name' => 'Ibague'],
            ['name' => 'Ipiales'],
            ['name' => 'Itagui'],
            ['name' => 'Manizales'],
            ['name' => 'Marinilla'],
            ['name' => 'Medellín'],
            ['name' => 'Monteria'],
            ['name' => 'Neiva'],
            ['name' => 'Pasto'],
            ['name' => 'Pereira'],
            ['name' => 'Pitalito'],
            ['name' => 'Popayan'],
            ['name' => 'Rionegro'],
            ['name' => 'Santa Marta'],
            ['name' => 'Sincelejo'],
            ['name' => 'Sogamoso'],
            ['name' => 'Tocancipa'],
            ['name' => 'Tunja'],
            ['name' => 'Valledupar'],
            ['name' => 'Villavicencio'],
            ['name' => 'Yopal'],
            ['name' => 'Zipaquira'],
        ];

        DB::table('cities')->insert($cities);
    }
}
