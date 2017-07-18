<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_claims', function (Blueprint $table) {
            $table->increments('id_log')->unique();
            $table->integer('id_user');
            $table->string('id_claim', 10);
            $table->integer('id_activity');
            $table->timestamps('date_log');
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_claims');
    }
}
