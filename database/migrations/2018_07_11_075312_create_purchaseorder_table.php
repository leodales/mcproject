<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorder', function (Blueprint $table) {
          
            $table->integer('PONUM')->unique();
            $table->string('TITLENAME')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('ORDERQTY')->nullable();
            $table->double('UNITPRICE')->nullable();
            $table->double('TOTALPRICE')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchaseorder');
    }
}