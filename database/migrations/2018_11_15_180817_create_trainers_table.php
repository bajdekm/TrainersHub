<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('voivodeship')->nullable();
            $table->string('street')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('buildingNumber')->nullable();
            $table->string('flatNumber')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->integer('opinionsSum')->nullable();
            $table->double('opinionsAverage')->nullable();
            $table->string('email')->nullable()->unique();
            $table->longText('competences')->nullable();
            $table->longText('experiences')->nullable();
            $table->longText('instagramProfile')->nullable();
            $table->longText('facebookProfile')->nullable();
            $table->longText('snapchatProfile')->nullable();
            $table->string('picture')->nullable();
            $table->string('picture2')->nullable();
            $table->string('picture3')->nullable();
            $table->string('sex')->default('man');
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
        Schema::dropIfExists('trainers');
    }
}
