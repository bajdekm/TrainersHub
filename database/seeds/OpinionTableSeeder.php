<?php

use Illuminate\Database\Seeder;
use App\Opinion;

class OpinionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trainerBartosz = \App\Trainer::where('name','Bartosz')->first();
        $trainerArtur = \App\Trainer::where('name','Artur')->first();
        $userUser = \App\User::where('name','User')->first();
        $userMarta = \App\User::where('name','Marta')->first();
        $userAdam = \App\User::where('name','Adam')->first();
        $userDawid = \App\User::where('name','Dawid')->first();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userUser);
        $opinion_1->trainer()->associate($trainerArtur);
        $opinion_1->rating = 5;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Profesjonalne podejście do sprawy. Korzystałem już wcześniej z innych usług tego typu, ale profesjonalizm i zaangażowanie ze strony Pana Damiana, zasługuje na najwyższą ocenę. Sam osobiście przyszedłem z zamiarem doboru planu treningowego, diety + szybkiej konsultacji, a otrzymałem za to alternatywne i dużo lepsze rozwiązanie dla mnie i mojego ciała, dzięki czemu jeszcze bardziej uwierzyłem sens ćwiczeń i zostałem zmotywowany do granic możliwości. To będzie dobry trening ! Polecam wszystkim i sam osobiście już zostaje przy Panu Damianie.';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userMarta);
        $opinion_1->trainer()->associate($trainerArtur);
        $opinion_1->approved = true;
        $opinion_1->rating = 4;
        $opinion_1->comment = 'Generalnie miałem obawy co do bycia pierwszym klientem z booksy ale profesjonalne podejście i przede wszystkim rozeznanie Damiana w temacie wartości odżywczych było imponujące, może dlatego że nie znam się zupełnie na temacie żywienia. Fakt faktem dietki jeszcze nie mam (mam ją otrzymać mailem) to najlepsze w konsultacji było to, że nie musiałem rezygnować z moich ulubionych składników a Damian dopasował wstępne posiłki pod kątem raczej smaku aniżeli konieczności spożywania czegoś do czego nie jestem przyzwyczajony. Jak na pierwszą wizytę - mega jestem zadowolony. Zobaczymy jak się rozwinie nasza współpraca ale już po pierwszej konsultacji zapowiada się ona obiecująco. Szczerze polecam';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userAdam);
        $opinion_1->trainer()->associate($trainerArtur);
        $opinion_1->rating = 3;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Tak se';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userDawid);
        $opinion_1->trainer()->associate($trainerArtur);
        $opinion_1->rating = 5;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Super!!!';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userUser);
        $opinion_1->trainer()->associate($trainerBartosz);
        $opinion_1->rating = 5;
        $opinion_1->approved = true;
        $opinion_1->comment = 'The best personal trainer in the earth!';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userMarta);
        $opinion_1->trainer()->associate($trainerBartosz);
        $opinion_1->rating = 4;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Excellent';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userAdam);
        $opinion_1->trainer()->associate($trainerBartosz);
        $opinion_1->rating = 1;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Tak se';
        $opinion_1->save();

        $opinion_1 = new Opinion();
        $opinion_1->user()->associate($userDawid);
        $opinion_1->trainer()->associate($trainerBartosz);
        $opinion_1->rating = 4;
        $opinion_1->approved = true;
        $opinion_1->comment = 'Super!!!';
        $opinion_1->save();

    }
}
