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
        $this->call(RoleTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(FacilityTableSeeder::class);
        $this->call(GymTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DisciplineTableSeeder::class);
        $this->call(TrainerTableSeeder::class);
        $this->call(MessageTableSeeder::class);
//        $this->call(DisciplineTrainerTableSeeder::class);
        $this->call(ReservationTableSeeder::class);
        $this->call(OpinionTableSeeder::class);
    }
}
