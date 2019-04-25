<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('site')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('country')->nullable();
            $table->string('sex')->default('man');
            $table->string('city')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('register_origin')->nullable();
            $table->string('email')->unique();
            $table->integer('city_id')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('picture')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
