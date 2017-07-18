<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_attachments', function (Blueprint $table) {
            $table->increments('id_attachment')->unique();
            $table->string('id_claim', 10);
            $table->string('path_attachment', 50);
            $table->string('nama_attachment', 25);
            
           
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
        Schema::dropIfExists('claim_attachments');
    }
}
