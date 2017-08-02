<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->increments('id_flow')->unique();
            $table->string('kode_flow', 30);
            $table->string('nama_flow', 50);
            $table->integer('id_role');
            $table->integer('level_flow');
            $table->integer('reserve1')->nullable();
            $table->integer('reserve2')->nullable();
            $table->integer('reserve3')->nullable();
            $table->string('reserve4',255)->nullable();
            $table->string('reserve5',255)->nullable();
            $table->string('reserve6',255)->nullable();
            $table->timestamps('reserve7')->nullable();
            $table->timestamps('reserve8')->nullable();
            $table->timestamps('reserve9')->nullable();
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
        Schema::dropIfExists('flows');
    }
}
