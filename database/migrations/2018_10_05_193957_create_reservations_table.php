<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('discipline_trainer_id')->unsigned()->nullable();
            $table->integer('discipline_id')->unsigned()->nullable();
            $table->integer('gym_id')->unsigned()->nullable();
            $table->integer('trainer_id')->unsigned()->nullable();
            $table->boolean('isApprovedByUser')->default(false);
            $table->boolean('isApprovedByTrainer')->default(false);
            $table->dateTime('trainingStart')->nullable();
            $table->dateTime('trainingEnd')->nullable();
            $table->dateTime('trainingDuration')->nullable();
            $table->boolean('wasTrainingRealized')->default(false);
            $table->double('price', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
