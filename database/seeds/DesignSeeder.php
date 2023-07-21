<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designs = [
            ['name' => 'Conti e.Contact', 'brand_id' => 1],
            ['name' => 'Altimax RT', 'brand_id' => 2],
            ['name' => 'ContiPowerContact', 'brand_id' => 1],
            ['name' => 'Altimax HP', 'brand_id' => 2],
            ['name' => 'ContiEcoContact 3', 'brand_id' => 1],
            ['name' => 'ContiPremiumContact 2', 'brand_id' => 1],
            ['name' => 'PowerContact TX', 'brand_id' => 1],
            ['name' => 'ContiExtremeContact DW', 'brand_id' => 1],
            ['name' => 'G-MAX AS-03', 'brand_id' => 2],
            ['name' => 'ContiPremiumContact 5', 'brand_id' => 1],
            ['name' => 'ContiProContact', 'brand_id' => 1],
            ['name' => 'ContiSportContact 2', 'brand_id' => 1],
            ['name' => 'ContiExtremeContact DWS06', 'brand_id' => 1],
            ['name' => 'ContiPremiumContact', 'brand_id' => 1],
            ['name' => 'ContiExtremeContact DWS', 'brand_id' => 1],
            ['name' => 'ContiSportContact', 'brand_id' => 1],
            ['name' => 'TrueContact', 'brand_id' => 1],
            ['name' => 'ContiSportContact 3', 'brand_id' => 1],
            ['name' => 'ContiSportContact 5', 'brand_id' => 1],
            ['name' => 'ProContact TX', 'brand_id' => 1],
            ['name' => 'ContiSportContact 5P', 'brand_id' => 1],
            ['name' => 'ContiSportContact 6', 'brand_id' => 1],
            ['name' => 'ContiForceContact', 'brand_id' => 1],
            ['name' => 'ContiCrossContact AT', 'brand_id' => 1],
            ['name' => 'Grabber AT2', 'brand_id' => 2],
            ['name' => 'Grabber SUV', 'brand_id' => 2],
            ['name' => 'Grabber AT', 'brand_id' => 2],
            ['name' => 'Grabber HP', 'brand_id' => 2],
            ['name' => 'Grabber HTS', 'brand_id' => 2],
            ['name' => 'Grabber MT', 'brand_id' => 2],
            ['name' => 'Grabber', 'brand_id' => 2],
            ['name' => 'ContiCrossContact LX', 'brand_id' => 1],
            ['name' => 'Grabber GT', 'brand_id' => 2],
            ['name' => 'ContiCrossContact LX20', 'brand_id' => 1],
            ['name' => 'Conti4x4Contact', 'brand_id' => 1],
            ['name' => 'Grabber UHP', 'brand_id' => 2],
            ['name' => 'ContiCrossContact UHP', 'brand_id' => 1],
            ['name' => 'ContiCrossContact LX2', 'brand_id' => 1],
            ['name' => 'ContiCrossContact LX Sport', 'brand_id' => 1],
            ['name' => 'Conti4X4SportContact', 'brand_id' => 1],
            ['name' => 'VancoContact 2', 'brand_id' => 1],
            ['name' => 'Vanco', 'brand_id' => 1],
            ['name' => 'Vanco 2', 'brand_id' => 1],
            ['name' => 'ContiVanContact 100', 'brand_id' => 1],
            ['name' => 'Vanco AP', 'brand_id' => 1],
            ['name' => 'G-MAX RS', 'brand_id' => 2],
            ['name' => 'ContiPremiumCont 2', 'brand_id' => 1],
            ['name' => 'ContiCrossContact ATR', 'brand_id' => 1],
            ['name' => 'Grabber X3', 'brand_id' => 2],
            ['name' => 'CrossContact LX20', 'brand_id' => 1],
            ['name' => 'ContiCrossCont UHP', 'brand_id' => 1],
            ['name' => 'VanContact AP', 'brand_id' => 1],
            ['name' => 'VancoFourSeason', 'brand_id' => 1],
            ['name' => 'Altmax XP7', 'brand_id' => 2],
            ['name' => 'CrossContact ATR', 'brand_id' => 1],
            ['name' => 'TERRAINCONTACT AT50', 'brand_id' => 1],
            ['name' => 'CrossContact UHP', 'brand_id' => 1],
            ['name' => 'ContiEcoContact 5', 'brand_id' => 1],
            ['name' => 'ExtremeContact DWS06', 'brand_id' => 1],
            ['name' => 'ExtremeContact DWS', 'brand_id' => 1],
            ['name' => 'ExtremeContact Sport', 'brand_id' => 1],
            ['name' => 'PremiumContact 6', 'brand_id' => 1],
            ['name' => 'SportContact 6', 'brand_id' => 1],
            ['name' => 'GRABBER ATX', 'brand_id' => 2],
            ['name' => 'ContiCrossContactLX2', 'brand_id' => 1],
            ['name' => 'PowerContact 2', 'brand_id' => 1],
        ];

        DB::table('design')->insert($designs);
    }
}
