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
            $table->string('id_claim',12)->unique;
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
            $table->string('courier',100)->nullable();
            $table->integer('doc_check1')->nullable();
            $table->integer('doc_check2')->nullable();
            $table->integer('doc_check3')->nullable();
            $table->integer('doc_check4')->nullable();
            $table->integer('doc_check5')->nullable();
            $table->integer('doc_check6')->nullable();
            $table->integer('doc_check7')->nullable();
            $table->integer('doc_check8')->nullable();
            $table->integer('doc_check9')->nullable();
            $table->integer('reserve1')->nullable();
            $table->integer('reserve2')->nullable();
            $table->integer('reserve3')->nullable();
            $table->string('reserve4',255)->nullable();
            $table->string('reserve5',255)->nullable();
            $table->string('reserve6',255)->nullable();
            $table->timestamps('reserve7')->nullable();
            $table->timestamps('reserve8')->nullable();
            $table->timestamps('reserve9')->nullable();
            
            
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
