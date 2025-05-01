<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrowavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microwaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mwstncode', 200)->nullable();
            $table->string('oprcd', 200)->nullable();
            $table->string('mwstncdopr', 200)->nullable();
            $table->string('mwstnname', 200)->nullable();
            $table->string('district', 200)->nullable();
            $table->string('vdc', 200)->nullable();
            $table->string('ward', 200)->nullable();
            $table->string('strtname', 200)->nullable();

            //Information on Geometry
            $table->string('lat', 200)->nullable();
            $table->string('long', 200)->nullable();
            $table->point('geom','GEOMETRY',4326)->nullable();
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
        Schema::dropIfExists('microwaves');
    }
}
