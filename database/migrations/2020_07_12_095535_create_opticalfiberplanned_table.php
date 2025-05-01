<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpticalfiberplannedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opticalfiberplanned', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('oflinkid', 200)->nullable();
            $table->string('oprlinkid', 200)->nullable();
            $table->string('lnkname', 200)->nullable();
            $table->string('oprcd', 200)->nullable();
            $table->string('length', 200)->nullable();
            $table->string('orgnodeid', 200)->nullable();
            $table->string('endnodeid', 200)->nullable();
            $table->string('cabletyp', 200)->nullable();
            $table->string('fibers', 200)->nullable();
            $table->string('capacity', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->linestring('geom','GEOMETRY',0)->nullable();
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
        Schema::dropIfExists('opticalfiberplanned');
    }
}
