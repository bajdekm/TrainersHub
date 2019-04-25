<?php

use Illuminate\Database\Seeder;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discipline_trainer = \App\discipline_trainer::where('id',1)->first();
        $discipline_trainer2 = \App\discipline_trainer::where('id',2)->first();
        $discipline_trainer3 = \App\discipline_trainer::where('id',2)->first();

        $trainerBartosz = \App\Trainer::where('name','Bartosz')->first();
        $trainerArtur = \App\Trainer::where('name','Artur')->first();
        $userUser = \App\User::where('name','User')->first();
        $userMarta = \App\User::where('name','Marta')->first();
        $userAdam = \App\User::where('name','Adam')->first();
        $userDawid = \App\User::where('name','Dawid')->first();
        $gymSportera = \App\Gym::where('name','Sportera')->first();
        $gymFit10= \App\Gym::where('name','Fit Fabric 1.0')->first();
        $disciplineCrossfit = \App\Discipline::where('name','Crossfit')->first();
        $disciplineLiftingWeights = \App\Discipline::where('name','Lifting Weights')->first();

        $reservation1 = new \App\Reservation();
        $reservation1->trainer()->associate($trainerBartosz);
        $reservation1->discipline()->associate($disciplineCrossfit);
        $reservation1->user()->associate($userUser);
        $reservation1->gym()->associate($gymSportera);
        $reservation1->disciplineTrainer()->associate($discipline_trainer);
        $reservation1->trainingStart = new DateTime();
        $reservation1->trainingEnd = new DateTime();
        $reservation1->isApprovedByUser = true;
        $reservation1->isApprovedByTrainer = true;
        $reservation1->wasTrainingRealized = true;
        $reservation1->price = 105.00;
        $reservation1->save();

        $reservation2 = new \App\Reservation();
        $reservation2->trainer()->associate($trainerArtur);
        $reservation2->discipline()->associate($disciplineLiftingWeights);
        $reservation2->user()->associate($userAdam);
        $reservation2->gym()->associate($gymFit10);
        $reservation2->trainingStart = new DateTime();
        $reservation2->trainingEnd = new DateTime();
        $reservation2->isApprovedByUser = true;
        $reservation2->isApprovedByTrainer = true;
        $reservation2->wasTrainingRealized = true;
        $reservation2->price = 100.00;
        $reservation2->save();

        $reservation3 = new \App\Reservation();
        $reservation3->trainer()->associate($trainerArtur);
        $reservation3->discipline()->associate($disciplineLiftingWeights);
        $reservation3->user()->associate($userMarta);
        $reservation3->gym()->associate($gymFit10);
        $reservation3->trainingStart = new DateTime();
        $reservation3->trainingEnd = new DateTime();
        $reservation3->isApprovedByUser = true;
        $reservation3->isApprovedByTrainer = true;
        $reservation3->wasTrainingRealized = true;
        $reservation3->price = 100.00;
        $reservation3->save();

        $reservation4 = new \App\Reservation();
        $reservation4->trainer()->associate($trainerBartosz);
        $reservation4->disciplineTrainer()->associate($discipline_trainer2);
        $reservation4->user()->associate($userAdam);
        $reservation4->gym()->associate($gymSportera);
        $reservation4->trainingStart = new DateTime();
        $reservation4->trainingEnd = new DateTime();
        $reservation4->isApprovedByUser = true;
        $reservation4->isApprovedByTrainer = true;
        $reservation4->wasTrainingRealized = true;
        $reservation4->price = 110.00;
        $reservation4->save();

        $reservation5 = new \App\Reservation();
        $reservation5->trainer()->associate($trainerBartosz);
        $reservation5->disciplineTrainer()->associate($discipline_trainer3);
        $reservation5->user()->associate($userDawid);
        $reservation5->gym()->associate($gymSportera);
        $reservation5->trainingStart = new DateTime();
        $reservation5->trainingEnd = new DateTime();
        $reservation5->isApprovedByUser = true;
        $reservation5->isApprovedByTrainer = true;
        $reservation5->wasTrainingRealized = true;
        $reservation5->price = 80.00;
        $reservation5->save();

        $reservation6 = new \App\Reservation();
        $reservation6->trainer()->associate($trainerArtur);
        $reservation6->discipline()->associate($disciplineLiftingWeights);
        $reservation6->user()->associate($userDawid);
        $reservation6->gym()->associate($gymSportera);
        $reservation6->trainingStart = new DateTime();
        $reservation6->trainingEnd = new DateTime();
        $reservation6->isApprovedByUser = true;
        $reservation6->isApprovedByTrainer = false;
        $reservation6->wasTrainingRealized = false;
        $reservation6->price = 120.00;
        $reservation6->save();

        $reservation7 = new \App\Reservation();
        $reservation7->trainer()->associate($trainerBartosz);
        $reservation7->disciplineTrainer()->associate($discipline_trainer);
        $reservation7->user()->associate($userMarta);
        $reservation7->gym()->associate($gymFit10);
        $reservation7->trainingStart = new DateTime();
        $reservation7->trainingEnd = new DateTime();
        $reservation7->isApprovedByUser = true;
        $reservation7->isApprovedByTrainer = false;
        $reservation7->wasTrainingRealized = false;
        $reservation7->price = 100.00;
        $reservation7->save();

        $reservation8 = new \App\Reservation();
        $reservation8->trainer()->associate($trainerBartosz);
        $reservation8->disciplineTrainer()->associate($discipline_trainer2);
        $reservation8->user()->associate($userUser);
        $reservation8->gym()->associate($gymFit10);
        $reservation8->trainingStart = new DateTime();
        $reservation8->trainingEnd = new DateTime();
        $reservation8->isApprovedByUser = false;
        $reservation8->isApprovedByTrainer = true;
        $reservation8->wasTrainingRealized = false;
        $reservation8->price = 150.00;
        $reservation8->save();

        $reservation9 = new \App\Reservation();
        $reservation9->trainer()->associate($trainerBartosz);
        $reservation9->disciplineTrainer()->associate($discipline_trainer3);
        $reservation9->user()->associate($userAdam);
        $reservation9->gym()->associate($gymFit10);
        $reservation9->trainingStart = new DateTime();
        $reservation9->trainingEnd = new DateTime();
        $reservation9->isApprovedByUser = true;
        $reservation9->isApprovedByTrainer = true;
        $reservation9->wasTrainingRealized = true;
        $reservation9->price = 90.00;
        $reservation9->save();

        $reservation10 = new \App\Reservation();
        $reservation10->trainer()->associate($trainerArtur);
        $reservation10->discipline()->associate($disciplineCrossfit);
        $reservation10->user()->associate($userAdam);
        $reservation10->gym()->associate($gymSportera);
        $reservation10->trainingStart = new DateTime();
        $reservation10->trainingEnd = new DateTime();
        $reservation10->isApprovedByUser = true;
        $reservation10->isApprovedByTrainer = true;
        $reservation10->wasTrainingRealized = true;
        $reservation10->price = 90.00;
        $reservation10->save();

        $reservation11 = new \App\Reservation();
        $reservation11->trainer()->associate($trainerBartosz);
        $reservation11->disciplineTrainer()->associate($discipline_trainer3);
        $reservation11->user()->associate($userDawid);
        $reservation11->gym()->associate($gymFit10);
        $reservation11->trainingStart = new DateTime();
        $reservation11->trainingEnd = new DateTime();
        $reservation11->isApprovedByUser = true;
        $reservation11->isApprovedByTrainer = true;
        $reservation11->wasTrainingRealized = true;
        $reservation11->price = 90.00;
        $reservation11->save();

        $reservation12 = new \App\Reservation();
        $reservation12->trainer()->associate($trainerBartosz);
        $reservation12->disciplineTrainer()->associate($discipline_trainer);
        $reservation12->user()->associate($userDawid);
        $reservation12->gym()->associate($gymFit10);
        $reservation12->trainingStart = new DateTime();
        $reservation12->trainingEnd = new DateTime();
        $reservation12->isApprovedByUser = true;
        $reservation12->isApprovedByTrainer = true;
        $reservation12->wasTrainingRealized = true;
        $reservation12->price = 140.00;
        $reservation12->save();

    }
}
