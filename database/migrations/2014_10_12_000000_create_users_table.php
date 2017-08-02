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
            $table->increments('id_user')->unique();
            $table->string('nama_user', 50);
            $table->string('email', 100);
            $table->string('password', 255);
            $table->string('email1', 50)->nullable();
            $table->string('email2', 50)->nullable();
            $table->string('email3', 50)->nullable();
            $table->string('email4', 50)->nullable();
            $table->string('email5', 50)->nullable();
            $table->string('email6', 50)->nullable();
            $table->string('email7', 50)->nullable();
            $table->string('email8', 50)->nullable();
            $table->string('email9', 50)->nullable();
            $table->integer('reserve1')->nullable();
            $table->integer('reserve2')->nullable();
            $table->integer('reserve3')->nullable();
            $table->string('reserve4',255)->nullable();
            $table->string('reserve5',255)->nullable();
            $table->string('reserve6',255)->nullable();
            $table->timestamps('reserve7')->nullable();
            $table->timestamps('reserve8')->nullable();
            $table->timestamps('reserve9')->nullable();
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
