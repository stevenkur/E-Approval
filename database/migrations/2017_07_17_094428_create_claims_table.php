<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->string('id_claim',11)->unique;
            $table->string('nama_category', 30);
            $table->string('category_type', 30);
            $table->string('nama_program', 75);
            $table->integer('value');
            $table->integer('entitlement');
            $table->integer('programforyear');
            $table->string('pr_number', 30);
            $table->string('invoice_number', 30);
            $table->string('airwaybill', 50);
            $table->string('payment_form', 50);
            $table->string('original_tax', 50);
            $table->string('nama_distributor', 100);
            $table->string('kode_flow', 30);
            $table->integer('level_flow');
            $table->string('status', 50);
            $table->timestamps('tanggal_claim');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
