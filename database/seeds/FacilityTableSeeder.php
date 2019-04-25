<?php

use Illuminate\Database\Seeder;

class FacilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facility1 = new \App\Facility();
        $facility1->name = "Multisport";
        $facility1->category = "PartnerCards";
        $facility1->save();

        $facility2 = new \App\Facility();
        $facility2->name = "FitProfit";
        $facility2->category = "PartnerCards";
        $facility2->save();

        $facility3 = new \App\Facility();
        $facility3->name = "BeFit";
        $facility3->category = "PartnerCards";
        $facility3->save();
    }
}
