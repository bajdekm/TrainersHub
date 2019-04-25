<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\User;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ff_gym = \App\Gym::where('name','Fit Fabric 1.0')->first();


        $company_1 = new Company();
        $company_1->name = 'FitFabric';
        $company_1->country = 'Poland';
        $company_1->city = 'Lodz';
        $company_1->street = 'Łąkowa';
        $company_1->buildingNumber = '12';
        $company_1->description = 'FitFabric is the best';
        $company_1->save();
        $company_1->gyms()->save($ff_gym);

        $company_2 = new Company();
        $company_2->name = 'TrenerzyPL';
        $company_2->description = 'TrenerzyPL is the best';
        $company_2->country = 'Poland';
        $company_2->city = 'Konin';
        $company_2->street = 'Nowowiejskiego';
        $company_2->buildingNumber = '21';
        $company_2->save();

        $company_3 = new Company();
        $company_3->name = 'Dziki';
        $company_3->description = 'Dziki sa the best';
        $company_3->country = 'Italy';
        $company_3->city = 'Rome';
        $company_3->street = 'Via Giorgia Perlasca';
        $company_3->buildingNumber = '31';
        $company_3->save();

        $company_4 = new Company();
        $company_4->name = 'Dziki2';
        $company_4->description = 'Dziki sa the best';
        $company_4->country = 'Italy';
        $company_4->city = 'Rome';
        $company_4->street = 'Via Giorgia Perlasca';
        $company_4->buildingNumber = '31';
        $company_4->save();

        $company_5 = new Company();
        $company_5->name = 'Dziki3';
        $company_5->description = 'Dziki sa the best';
        $company_5->country = 'Italy';
        $company_5->city = 'Rome';
        $company_5->street = 'Via Giorgia Perlasca';
        $company_5->buildingNumber = '31';
        $company_5->save();

        $company_6 = new Company();
        $company_6->name = 'Dziki4';
        $company_6->description = 'Dziki sa the best';
        $company_6->country = 'Italy';
        $company_6->city = 'Rome';
        $company_6->street = 'Via Giorgia Perlasca';
        $company_6->buildingNumber = '31';
        $company_6->save();

        $company_7 = new Company();
        $company_7->name = 'Dziki5';
        $company_7->description = 'Dziki sa the best';
        $company_7->country = 'Italy';
        $company_7->city = 'Rome';
        $company_7->street = 'Via Giorgia Perlasca';
        $company_7->buildingNumber = '31';
        $company_7->save();

        $company_8 = new Company();
        $company_8->name = 'Dziki6';
        $company_8->description = 'Dziki sa the best';
        $company_8->country = 'Italy';
        $company_8->city = 'Rome';
        $company_8->street = 'Via Giorgia Perlasca';
        $company_8->buildingNumber = '31';
        $company_8->save();

        $company_9 = new Company();
        $company_9->name = 'Dziki7';
        $company_9->description = 'Dziki sa the best';
        $company_9->country = 'Italy';
        $company_9->city = 'Rome';
        $company_9->street = 'Via Giorgia Perlasca';
        $company_9->buildingNumber = '31';
        $company_9->save();

        $company_10 = new Company();
        $company_10->name = 'Dziki8';
        $company_10->description = 'Dziki sa the best';
        $company_10->country = 'Italy';
        $company_10->city = 'Rome';
        $company_10->street = 'Via Giorgia Perlasca';
        $company_10->buildingNumber = '31';
        $company_10->save();

        $company_11 = new Company();
        $company_11->name = 'Dziki9';
        $company_11->description = 'Dziki sa the best';
        $company_11->country = 'Italy';
        $company_11->city = 'Rome';
        $company_11->street = 'Via Giorgia Perlasca';
        $company_11->buildingNumber = '31';
        $company_11->save();
    }
}
