<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->text('country');
            $table->text('city');
            $table->text('street');
            $table->text('buildingNumber');
            $table->text('postalCode')->nullable();
            $table->string('fullAddress')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('hasOwner')->default(false);
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('email')->unique()->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
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
        Schema::dropIfExists('gyms');
    }
}
