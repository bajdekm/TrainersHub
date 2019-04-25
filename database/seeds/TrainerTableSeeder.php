<?php

use Illuminate\Database\Seeder;

class TrainerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discipline_imprezy_firmowe = \App\Discipline::where('name','Imprezy firmowe')->first();
        $discipline_asg = \App\Discipline::where('name','ASG')->first();
        $discipline_okolicznosciowe = \App\Discipline::where('name','Imprezy okolicznościowe')->first();
        $discipline_gra_otwarta = \App\Discipline::where('name','Gry otwarte')->first();
//        $discipline_pakiet_200 = \App\Discipline::where('name','Pakiet 200 kul')->first();

        $trainer_Trainer = \App\User::where('name','Trainer')->first();
        $trainer_Artur = \App\User::where('name','Artur')->first();
        $trainer_FitFabric = \App\User::where('name','FitFabric')->first();
        $trainer_TrenerzyPL = \App\User::where('name','TrenerzyPL')->first();
        $trainer_TrenerzyPL2 = \App\User::where('name','TrenerzyPL2')->first();
        $trainer_TrenerzyPL3 = \App\User::where('name','TrenerzyPL3')->first();

        $dziki_comp = \App\Company::where('name','Dziki')->first();
        $ff_comp = \App\Company::where('name','FitFabric')->first();

        $city_Konin = \App\Cities::where('name','Konin')->first();
        $city_Warszawa = \App\Cities::where('name','Warszawa')->first();
        $city_Lodz = \App\Cities::where('name','Łódź')->first();

        $tr = new \App\Trainer();
        $tr->name = 'Bartosz';
        $tr->surname = 'Tesciak';
        $tr->description = 'Some test description';
        $tr->email = 'zrobBatchaNa@email.com';
        $tr->phone = '725524217';
        $tr->city = 'Łódź';
        $tr->voivodeship = 'Łódzkie';
        $tr->street = 'Warszawska';
        $tr->postalCode = '91-862';
        $tr->buildingNumber = '8';
        $tr->flatNumber = '25';
        $tr->instagramProfile = 'https://instagram.com/annalewandowskahpba/?hl=pl';
        $tr->facebookProfile = 'https://www.facebook.com/artur.kolasa.12';
        $tr->snapchatProfile = 'kloz92';
        $tr->website = 'http://www.arkolopal.pl/';
        $tr->user()->associate($trainer_Trainer);
        $tr->company()->associate($dziki_comp);
        $tr->experiences = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis massa est. Nunc fringilla non ante sit amet elementum. Pellentesque non ante libero. Ut interdum ultricies justo lobortis sollicitudin. Etiam euismod volutpat ante id pellentesque. Nulla vestibulum feugiat ligula, quis euismod orci malesuada ac. Pellentesque sem libero, gravida hendrerit lobortis quis, mattis vel mi. Vivamus lobortis finibus posuere. In ut porttitor eros. Nullam placerat cursus ultricies. Aenean a molestie nulla. In et fermentum turpis.';
        $tr->save();
        $tr->disciplines()->attach($discipline_imprezy_firmowe);
//        $tr->disciplines()->attach($discipline_pakiet_200,['price' => 80, 'hoursDuration' => 2.5]);
        $tr->disciplines()->attach($discipline_asg);
        $tr->cities()->attach($city_Lodz);


        $tr1 = new \App\Trainer();
        $tr1->name = 'Artur';
        $tr1->surname = 'Kolasa';
        $tr1->description = 'Another test description';
        $tr1->competences = 'crossfit';
        $tr1->city = 'Łódź';
        $tr1->street = 'Warszawska';
        $tr1->voivodeship = 'Łódzkie';
        $tr1->postalCode = '91-862';
        $tr1->buildingNumber = '8';
        $tr1->flatNumber = '1';
        $tr1->phone = '725524217';
        $tr1->email = 'kolasa.artur@gmail.com';
        $tr1->instagramProfile = 'https://www.instagram.com/annalewandowskahpba/?hl=pl';
        $tr1->facebookProfile = 'https://www.facebook.com/artur.kolasa.12';
        $tr1->snapchatProfile = 'https://www.snapchat.com/add/kloz92';
        $tr1->website = 'https://www.fitfabric.pl/';
        $tr1->experiences = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis massa est. Nunc fringilla non ante sit amet elementum. Pellentesque non ante libero. Ut interdum ultricies justo lobortis sollicitudin. Etiam euismod volutpat ante id pellentesque. Nulla vestibulum feugiat ligula, quis euismod orci malesuada ac. Pellentesque sem libero, gravida hendrerit lobortis quis, mattis vel mi. Vivamus lobortis finibus posuere. In ut porttitor eros. Nullam placerat cursus ultricies. Aenean a molestie nulla. In et fermentum turpis.

Duis a vehicula velit, vel luctus ipsum. Sed sagittis libero sed elit ullamcorper, ac venenatis justo sagittis. Morbi nunc dolor, dictum quis scelerisque in, blandit non orci. Aliquam erat volutpat. Quisque tristique urna at finibus dapibus. Proin quis arcu sem. Maecenas eget risus metus. Donec tempor elit in neque posuere, id cursus nunc elementum. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc porta interdum lectus, non mattis libero tempor eu.';
        $tr1->user()->associate($trainer_Artur);
        $tr1->company()->associate($ff_comp);
        $tr1->save();
        $tr1->disciplines()->attach($discipline_imprezy_firmowe);
        $tr1->disciplines()->attach($discipline_okolicznosciowe);
        $tr1->disciplines()->attach($discipline_asg);
        $tr1->disciplines()->attach($discipline_gra_otwarta);
        $tr1->cities()->attach($city_Lodz);


        $tr1 = new \App\Trainer();
        $tr1->name = 'Marek';
        $tr1->surname = 'Markowski';
        $tr1->description = 'Another test description';
        $tr1->competences = 'crossfit';
        $tr1->city = 'Warszawa';
        $tr1->voivodeship = 'Mazowieckie';
        $tr1->experiences = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis massa est. Nunc fringilla non ante sit amet elementum. Pellentesque non ante libero. Ut interdum ultricies justo lobortis sollicitudin. Etiam euismod volutpat ante id pellentesque. Nulla vestibulum feugiat ligula, quis euismod orci malesuada ac. Pellentesque sem libero, gravida hendrerit lobortis quis, mattis vel mi. Vivamus lobortis finibus posuere. In ut porttitor eros. Nullam placerat cursus ultricies. Aenean a molestie nulla. In et fermentum turpis.

Duis a vehicula velit, vel luctus ipsum. Sed sagittis libero sed elit ullamcorper, ac venenatis justo sagittis. Morbi nunc dolor, dictum quis scelerisque in, blandit non orci. Aliquam erat volutpat. Quisque tristique urna at finibus dapibus. Proin quis arcu sem. Maecenas eget risus metus. Donec tempor elit in neque posuere, id cursus nunc elementum. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc porta interdum lectus, non mattis libero tempor eu.';
        $tr1->user()->associate($trainer_FitFabric);
        $tr1->company()->associate($ff_comp);
        $tr1->save();
        $tr1->disciplines()->attach($discipline_imprezy_firmowe);
        $tr1->cities()->attach($city_Warszawa);


        $tr1 = new \App\Trainer();
        $tr1->name = 'Adam';
        $tr1->surname = 'Adamowski';
        $tr1->description = 'Another test description';
        $tr1->competences = 'crossfit';
        $tr1->city = 'Warszawa';
        $tr1->voivodeship = 'Mazowieckie';
        $tr1->experiences = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis massa est. Nunc fringilla non ante sit amet elementum. Pellentesque non ante libero. Ut interdum ultricies justo lobortis sollicitudin. Etiam euismod volutpat ante id pellentesque. Nulla vestibulum feugiat ligula, quis euismod orci malesuada ac. Pellentesque sem libero, gravida hendrerit lobortis quis, mattis vel mi. Vivamus lobortis finibus posuere. In ut porttitor eros. Nullam placerat cursus ultricies. Aenean a molestie nulla. In et fermentum turpis.

Duis a vehicula velit, vel luctus ipsum. Sed sagittis libero sed elit ullamcorper, ac venenatis justo sagittis. Morbi nunc dolor, dictum quis scelerisque in, blandit non orci. Aliquam erat volutpat. Quisque tristique urna at finibus dapibus. Proin quis arcu sem. Maecenas eget risus metus. Donec tempor elit in neque posuere, id cursus nunc elementum. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc porta interdum lectus, non mattis libero tempor eu.';
        $tr1->user()->associate($trainer_TrenerzyPL);
        $tr1->company()->associate($ff_comp);
        $tr1->save();
        $tr1->disciplines()->attach($discipline_imprezy_firmowe);
        $tr1->disciplines()->attach($discipline_okolicznosciowe);

        $tr1 = new \App\Trainer();
        $tr1->name = 'Marta';
        $tr1->surname = 'Pinciak';
        $tr1->description = 'Another test description';
        $tr1->competences = 'crossfit';
        $tr1->city = 'Warszawa';
        $tr1->voivodeship = 'Mazowieckie';
        $tr1->user()->associate($trainer_TrenerzyPL2);
        $tr1->company()->associate($ff_comp);
        $tr1->save();
        $tr1->disciplines()->attach($discipline_imprezy_firmowe);
        $tr1->disciplines()->attach($discipline_okolicznosciowe);
        $tr1->disciplines()->attach($discipline_asg);
        $tr1->cities()->attach($city_Warszawa);


        $tr1 = new \App\Trainer();
        $tr1->name = 'Marta';
        $tr1->surname = 'Martowska';
        $tr1->description = 'Another test description';
        $tr1->competences = 'crossfit';
        $tr1->city = 'Warszawa';
        $tr1->voivodeship = 'Mazowieckie';
        $tr1->user()->associate($trainer_TrenerzyPL3);
        $tr1->company()->associate($ff_comp);
        $tr1->save();
        $tr1->disciplines()->attach($discipline_okolicznosciowe);
        $tr1->disciplines()->attach($discipline_asg);
        $tr1->cities()->attach($city_Warszawa);



    }
}
