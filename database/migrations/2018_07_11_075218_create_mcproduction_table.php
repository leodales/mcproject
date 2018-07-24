


<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  CreateMcproductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcproduction', function (Blueprint $table) {
            $table->string('PODATE')->nullable();
            $table->integer('PBONUM')->unique();
            $table->integer('COMNUM')->nullable();
            $table->char('COMMITMENTTYPE',1)->nullable();
            $table->string('TITLE')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('NEWBOOKFLAG')->nullable();
            $table->integer('PRINTERCODE')->nullable();
            $table->string('PRINTERNAME')->nullable();
            $table->string('TITLESERIAL')->nullable();
            $table->string('PRODUCTCATEGORY')->nullable();
            $table->string('EXTENT_COVER')->nullable();
            $table->integer('HEIGHT')->nullable();
            $table->integer('WIDTH')->nullable();
            $table->string('USAGE1')->nullable();
            $table->string('PAPERTYPE1')->nullable();
            $table->string('FINISHING1')->nullable();
            $table->string('NUMOFCOLOUR1')->nullable();
            $table->integer('EXTENT')->nullable();
            $table->string('USAGE2')->nullable();
            $table->string('PAPERTYPE2')->nullable();
            $table->string('FINISHING2')->nullable();
            $table->string('NUMOFCOLOUR2')->nullable();
            $table->string('BINDING')->nullable();
            $table->string('POQTY')->nullable();
            $table->string('TOTALUNIT')->nullable();
            $table->string('TOTALCOST')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcproduction');
    }
}
