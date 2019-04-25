<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        companies
        $dziki_comp = \App\Company::where('name','Dziki')->first();
        $ff_comp = \App\Company::where('name','FitFabric')->first();
        $trenerzy_comp = \App\Company::where('name','TrenerzyPL')->first();

//        roles
        $role_usr = \App\Role::where('name','user')->first();
        $role_adm = \App\Role::where('name','admin')->first();
        $role_train = \App\Role::where('name','trainer')->first();
        $role_cmp = \App\Role::where('name','company')->first();

        $gym_ff = \App\Gym::where('name','Fit Fabric 1.0')->first();
        $gym_sportera = \App\Gym::where('name','Sportera')->first();

        $city_Konin = \App\Cities::where('name','Konin')->first();
        $city_Warszawa = \App\Cities::where('name','Warszawa')->first();
        $city_Lodz = \App\Cities::where('name','Łódź')->first();

        $usr = new \App\User();
        $usr->name = 'User';
        $usr->surname = 'User';
        $usr->login = 'user';
        $usr->city = 'Lodz';
        $usr->email = 'user@user.pl';
        $usr->birthdate = '1992-04-21';
        $usr->password = bcrypt('password');
        $usr->save();
        \App\Utils\CommonUtil::createUserDirectory($usr->name);
        $usr->roles()->attach($role_usr);
        $usr->cities()->attach($city_Lodz);

        $usr2 = new \App\User();
        $usr2->name = 'Adam';
        $usr2->surname = 'Kowalski';
        $usr2->login = 'akowalski';
        $usr2->city = 'Warszawa';
        $usr2->email = 'akowalski@akowalski.pl';
        $usr2->birthdate = '1992-04-21';
        $usr2->password = bcrypt('password');
        $usr2->save();
        \App\Utils\CommonUtil::createUserDirectory($usr2->name);
        $usr2->roles()->attach($role_usr);
        $usr2->cities()->attach($city_Warszawa);


        $usr3 = new \App\User();
        $usr3->name = 'Marta';
        $usr3->surname = 'Pinciak';
        $usr3->login = 'mpinciak';
        $usr3->city = 'Lodz';
        $usr3->email = 'mpinciak@mpinciak.pl';
        $usr3->birthdate = '1992-04-21';
        $usr3->password = bcrypt('password');
        $usr3->save();
        \App\Utils\CommonUtil::createUserDirectory($usr3->name);
        $usr3->roles()->attach($role_usr);

        $usr4 = new \App\User();
        $usr4->name = 'Dawid';
        $usr4->surname = 'Kolasa';
        $usr4->login = 'dkolasa';
        $usr4->city = 'Lodz';
        $usr4->email = 'dkolasa@dkolasa.pl';
        $usr4->birthdate = '1992-04-21';
        $usr4->password = bcrypt('password');
        $usr4->save();
        \App\Utils\CommonUtil::createUserDirectory($usr4->name);
        $usr4->roles()->attach($role_usr);
        $usr4->cities()->attach($city_Lodz);


        $adm = new \App\User();
        $adm->name = 'Admin';
        $adm->surname = 'User';
        $adm->login = 'admin';
        $adm->city = 'Lodz';
        $adm->email = 'admin@admin.pl';
        $adm->birthdate = '1992-08-20';
        $adm->password = bcrypt('password');
        $adm->save();
        \App\Utils\CommonUtil::createUserDirectory($adm->name);
        $adm->roles()->attach($role_adm);
        $adm->cities()->attach($city_Lodz);


        $train = new \App\User();
        $train->name = 'Trainer';
        $train->surname = 'User';
        $train->login = 'trainer';
        $train->city = 'Konin';
        $train->email = 'trainer@trainer.pl';
        $train->birthdate = '1992-01-21';
        $train->password = bcrypt('password');
        $train->save();
        \App\Utils\CommonUtil::createUserDirectory($train->name);
        $train->roles()->attach($role_train);
        $train->gyms()->attach($gym_ff);
        $train->cities()->attach($city_Konin);


        $train = new \App\User();
        $train->name = 'Artur';
        $train->surname = 'User';
        $train->login = 'atrainer';
        $train->city = 'Konin';
        $train->email = 'artur@trainer.pl';
        $train->birthdate = '1992-01-21';
        $train->password = bcrypt('password');
        $train->save();
        \App\Utils\CommonUtil::createUserDirectory($train->name);
        $train->roles()->attach($role_train);
        $train->gyms()->attach($gym_ff);


        $usr_cmp1 = new \App\User();
        $usr_cmp1->name = 'FitFabric';
        $usr_cmp1->surname = 'User';
        $usr_cmp1->login = 'ff';
        $usr_cmp1->city = 'Konin';
        $usr_cmp1->email = 'trainer@trainer.pl3';
        $usr_cmp1->birthdate = '1992-01-21';
        $usr_cmp1->password = bcrypt('password');
        $usr_cmp1->save();
        \App\Utils\CommonUtil::createUserDirectory($usr_cmp1->name);
        $usr_cmp1->roles()->attach($role_train);
        $usr_cmp1->company()->save($ff_comp);

        $usr_cmp2 = new \App\User();
        $usr_cmp2->name = 'TrenerzyPL';
        $usr_cmp2->surname = 'User';
        $usr_cmp2->login = 'tpl';
        $usr_cmp2->city = 'Konin';
        $usr_cmp2->email = 'tpl@tpl.pl';
        $usr_cmp2->birthdate = '1992-01-21';
        $usr_cmp2->password = bcrypt('password');
        $usr_cmp2->save();
        \App\Utils\CommonUtil::createUserDirectory($usr_cmp2->name);
        $usr_cmp2->roles()->attach($role_train);
        $usr_cmp2->company()->save($trenerzy_comp);
        $usr_cmp2->gyms()->attach($gym_ff);
        $usr_cmp2->gyms()->attach($gym_sportera);


        $usr_cmp2 = new \App\User();
        $usr_cmp2->name = 'TrenerzyPL2';
        $usr_cmp2->surname = 'User';
        $usr_cmp2->login = 'tpl2';
        $usr_cmp2->city = 'Konin';
        $usr_cmp2->email = 'tpl@tpl2.pl';
        $usr_cmp2->birthdate = '1992-01-21';
        $usr_cmp2->password = bcrypt('password');
        $usr_cmp2->save();
        $usr_cmp2->roles()->attach($role_train);
        $usr_cmp2->company()->save($trenerzy_comp);
        $usr_cmp2->gyms()->attach($gym_ff);
        $usr_cmp2->gyms()->attach($gym_sportera);

        $usr_cmp2 = new \App\User();
        $usr_cmp2->name = 'TrenerzyPL3';
        $usr_cmp2->surname = 'User';
        $usr_cmp2->login = 'tpl3';
        $usr_cmp2->city = 'Konin';
        $usr_cmp2->email = 'tpl@tpl3.pl';
        $usr_cmp2->birthdate = '1992-01-21';
        $usr_cmp2->password = bcrypt('password');
        $usr_cmp2->save();
        $usr_cmp2->roles()->attach($role_train);
        $usr_cmp2->company()->save($trenerzy_comp);
        $usr_cmp2->gyms()->attach($gym_ff);
        $usr_cmp2->gyms()->attach($gym_sportera);

        $usr_cmp2 = new \App\User();
        $usr_cmp2->name = 'TrenerzyPL1';
        $usr_cmp2->surname = 'User';
        $usr_cmp2->login = 'tpl1';
        $usr_cmp2->city = 'Konin';
        $usr_cmp2->email = 'tpl@tpl1.pl';
        $usr_cmp2->birthdate = '1992-01-21';
        $usr_cmp2->password = bcrypt('password');
        $usr_cmp2->save();
        $usr_cmp2->roles()->attach($role_cmp);
        $usr_cmp2->company()->save($trenerzy_comp);
        $usr_cmp2->gyms()->attach($gym_ff);
        $usr_cmp2->gyms()->attach($gym_sportera);

        $usr_cmp3 = new \App\User();
        $usr_cmp3->name = 'Dziki';
        $usr_cmp3->surname = 'User';
        $usr_cmp3->login = 'dziki';
        $usr_cmp3->city = 'Warszawa';
        $usr_cmp3->email = 'dziki@dziki.pl';
        $usr_cmp3->birthdate = '1992-01-21';
        $usr_cmp3->password = bcrypt('password');
        $usr_cmp3->save();
        \App\Utils\CommonUtil::createUserDirectory($usr_cmp3->name);
        $usr_cmp3->roles()->attach($role_cmp);
        $usr_cmp3->company()->save($dziki_comp);

    }
}
