<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subsidiaries = [
            ['name' => '7 de agosto', 'cities_id' => 1, 'profiles_id' => 1],
            ['name' => 'Batericars no. 10', 'cities_id' => 1, 'profiles_id' => 2],
            ['name' => 'Batericars no. 8', 'cities_id' => 1, 'profiles_id' => 2],
            ['name' => 'Merquellantas armenia', 'cities_id' => 1, 'profiles_id' => 2],
            ['name' => 'Merquellantas barranquilla', 'cities_id' => 2, 'profiles_id' => 2],
            ['name' => 'La rueda león tire', 'cities_id' => 2, 'profiles_id' => 3],
            ['name' => 'Ardillantas fusa', 'cities_id' => 3, 'profiles_id' => 2],
            ['name' => 'Csa éxito bello', 'cities_id' => 3, 'profiles_id' => 2],
            ['name' => 'Merquellantas la felicidad', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Al llantas', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Ardillantas bogotá', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Ardillantas fusa', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Csa éxito 170', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Csa éxito 80', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Csa éxito villamayor', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Dacar plus', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Llantas beto', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'Merquellantas bogotá', 'cities_id' => 4, 'profiles_id' => 2],
            ['name' => 'La rueda calle 170', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda calle 80', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda carrera', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda fontibón', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda hayuelos', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda paloquemao', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda puente aranda', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda quito', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda terminal', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda normandia', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'La rueda suba', 'cities_id' => 4, 'profiles_id' => 3],
            ['name' => 'Merquellantas bosconia', 'cities_id' => 5, 'profiles_id' => 2],
            ['name' => 'Merquellantas bucaramanga', 'cities_id' => 6, 'profiles_id' => 2],
            ['name' => 'Transpiedecuesta', 'cities_id' => 6, 'profiles_id' => 2],
            ['name' => 'Call llantas', 'cities_id' => 7, 'profiles_id' => 2],
            ['name' => 'Interllantas cali', 'cities_id' => 7, 'profiles_id' => 2],
            ['name' => 'Merquellantas cali', 'cities_id' => 7, 'profiles_id' => 2],
            ['name' => 'Dislubrival', 'cities_id' => 8, 'profiles_id' => 2],
            ['name' => 'Merquellantas cartagena', 'cities_id' => 8, 'profiles_id' => 2],
            ['name' => 'Llantas mallarino', 'cities_id' => 8, 'profiles_id' => 2],
            ['name' => 'Serviteca gomez velasquez', 'cities_id' => 9, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 10, 'profiles_id' => 2],
            ['name' => 'Multillantas fontanar', 'cities_id' => 10, 'profiles_id' => 2],
            ['name' => 'Merquellantas dos quebradas', 'cities_id' => 11, 'profiles_id' => 2],
            ['name' => 'Csa duitama', 'cities_id' => 12, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 13, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 14, 'profiles_id' => 2],
            ['name' => 'Merquellantas girardot', 'cities_id' => 15, 'profiles_id' => 2],
            ['name' => 'Merquellantas ibague', 'cities_id' => 16, 'profiles_id' => 2],
            ['name' => 'Batericars no. 5', 'cities_id' => 17, 'profiles_id' => 2],
            ['name' => 'Merquellantas itagui', 'cities_id' => 18, 'profiles_id' => 2],
            ['name' => 'Merquellantas manizales', 'cities_id' => 19, 'profiles_id' => 2],
            ['name' => 'Keluillantas', 'cities_id' => 20, 'profiles_id' => 2],
            ['name' => 'Casagrande', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Interllantas medellín', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Marllantas', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Servillantas la 57', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Tecnicentro eurogas', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Tecnicentro los colores', 'cities_id' => 21, 'profiles_id' => 2],
            ['name' => 'Su llanta', 'cities_id' => 22, 'profiles_id' => 2],
            ['name' => 'Merquellantas neiva', 'cities_id' => 23, 'profiles_id' => 2],
            ['name' => 'Andina de llantas', 'cities_id' => 24, 'profiles_id' => 2],
            ['name' => 'Batericars no. 4', 'cities_id' => 24, 'profiles_id' => 2],
            ['name' => 'Batericars no. 6', 'cities_id' => 24, 'profiles_id' => 2],
            ['name' => 'Batericars no. 7', 'cities_id' => 24, 'profiles_id' => 2],
            ['name' => 'Csa pereira', 'cities_id' => 25, 'profiles_id' => 2],
            ['name' => 'Est de serv de corales', 'cities_id' => 25, 'profiles_id' => 2],
            ['name' => 'Est de serv de pereira', 'cities_id' => 25, 'profiles_id' => 2],
            ['name' => 'Merquellantas pitalito', 'cities_id' => 26, 'profiles_id' => 2],
            ['name' => 'Batericars no. 9', 'cities_id' => 27, 'profiles_id' => 2],
            ['name' => 'Maxllantas', 'cities_id' => 28, 'profiles_id' => 2],
            ['name' => 'Merquellantas santa marta', 'cities_id' => 29, 'profiles_id' => 2],
            ['name' => 'Interllantas', 'cities_id' => 30, 'profiles_id' => 2],
            ['name' => 'Mundillantas', 'cities_id' => 31, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 32, 'profiles_id' => 2],
            ['name' => 'Casarana boutique', 'cities_id' => 33, 'profiles_id' => 2],
            ['name' => 'Inprollantas', 'cities_id' => 33, 'profiles_id' => 2],
            ['name' => 'Merquellantas valledupar', 'cities_id' => 34, 'profiles_id' => 2],
            ['name' => 'Merquellantas villavicencio', 'cities_id' => 35, 'profiles_id' => 2],
            ['name' => 'Merquellantas yopal', 'cities_id' => 36, 'profiles_id' => 2],
            ['name' => 'Multillantas la sabana', 'cities_id' => 37, 'profiles_id' => 2],
        ];
        DB::table('subsidiary')->insert($subsidiaries);
    }
}
