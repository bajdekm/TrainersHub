<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplineTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_trainer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discipline_id')->nullable()->unsigned();
            $table->integer('trainer_id')->nullable()->unsigned();
            $table->string('price', 8, 2)->default(0);
//            $table->double('price', 8, 2)->default(0);
            $table->integer('minutesDuration')->default(0);
            $table->double('hoursDuration')->default(0);
            $table->integer('quantity')->default(0);
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
        Schema::dropIfExists('discipline_trainer');
    }
}
