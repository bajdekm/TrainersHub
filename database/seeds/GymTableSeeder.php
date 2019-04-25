<?php

use Illuminate\Database\Seeder;

class GymTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facility_multi = \App\Facility::where('name','Multisport')->first();
        $facility_fitProfit= \App\Facility::where('name','FitProfit')->first();

        $gymFF1 = new \App\Gym();
        $gymFF1->name = "Fit Fabric 1.0";
        $gymFF1->country = "Poland";
        $gymFF1->city = "Lodz";
        $gymFF1->street = "Aleje Politechniki";
        $gymFF1->buildingNumber = 145;
        $gymFF1->description = "First Fit Fabric in Poland";
        $gymFF1->hasOwner = true;
        $gymFF1->latitude = 18.223460;
        $gymFF1->longitude = 52.185500;
        $gymFF1->save();
        $gymFF1->facilities()->attach($facility_fitProfit);
        $gymFF1->facilities()->attach($facility_multi);


        $gymSportera = new \App\Gym();
        $gymSportera->name = "Sportera";
        $gymSportera->country = "Poland";
        $gymSportera->city = "Lodz";
        $gymSportera->street = "Piotrkowska";
        $gymSportera->buildingNumber = 105;
        $gymSportera->description = "Sportera bumbum cyc cyc";
        $gymSportera->hasOwner = false;
        $gymSportera->latitude = 18.223560;
        $gymSportera->longitude = 52.175500;
        $gymSportera->save();
    }
}
