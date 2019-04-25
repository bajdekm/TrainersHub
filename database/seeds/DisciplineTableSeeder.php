<?php

use Illuminate\Database\Seeder;

class DisciplineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //paintball start
        $discipline2 = new \App\Discipline();
        $discipline2->name = "Imprezy firmowe";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Catering";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Ognisko/Grill";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Gry otwarte";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

/*        $discipline2 = new \App\Discipline();
        $discipline2->name = "Ilość scenariuszy";
        $discipline2->category = "Paintball offer";
        $discipline2->save();*/

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Imprezy okolicznościowe";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Ubezpieczenie OC";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Paintabll dla dzieci";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Wejście z własnym sprzętem";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "ASG";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Gra na powietrzu";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Gra w pomieszczeniu";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Paintball laserowy";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Faktura VAT";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

/*        $discipline2 = new \App\Discipline();
        $discipline2->name = "1 scenariusz";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "2 scenariusze";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "3 scenariusze";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "4 scenariusze";
        $discipline2->category = "Paintball offer";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "5 scenariuszy i więcej";
        $discipline2->category = "Paintball offer";
        $discipline2->save();*/

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Pakiet 100 kul";
        $discipline2->category = "Paintball pricing";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Pakiet 200 kul";
        $discipline2->category = "Paintball pricing";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Pakiet 300 kul";
        $discipline2->category = "Paintball pricing";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Pakiet 400 kul";
        $discipline2->category = "Paintball pricing";
        $discipline2->save();

        $discipline2 = new \App\Discipline();
        $discipline2->name = "Pakiet 500 kul";
        $discipline2->category = "Paintball pricing";
        $discipline2->save();
        //paintball stop


        $discipline_pakiet_200 = \App\Discipline::where('name','Pakiet 200 kul')->first();
        $discipline_asg = \App\Discipline::where('name','ASG')->first();
        $discipline_okolicznosciowe = \App\Discipline::where('name','Imprezy okolicznościowe')->first();
       $trainerBartosz = \App\Trainer::where('name','Bartosz')->first();
        /*
                $discipline_trainer = new \App\discipline_trainer();
                $discipline_trainer->trainer()->associate($trainerBartosz);
                $discipline_trainer->discipline()->associate($discipline_imprezy_firmowe);
                $discipline_trainer->save();

                $discipline_trainer = new \App\discipline_trainer();
                $discipline_trainer->trainer()->associate($trainerBartosz);
                $discipline_trainer->discipline()->associate($discipline_asg);
                $discipline_trainer->save();*/

/*        $discipline_trainer = new \App\discipline_trainer();
        $discipline_trainer->trainer()->associate($trainerBartosz);
        $discipline_trainer->discipline()->associate($discipline_pakiet_200);
        $discipline_trainer->price = 80;
        $discipline_trainer->minutesDuration = 60;
        $discipline_trainer->save();*/

/*        $discipline_trainer = new \App\discipline_trainer();
        $discipline_trainer->trainer()->associate($trainerBartosz);
        $discipline_trainer->discipline()->associate($discipline_okolicznosciowe);
        $discipline_trainer->save();*/
    }
}
