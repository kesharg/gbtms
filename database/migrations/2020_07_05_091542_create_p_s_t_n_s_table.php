<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePSTNSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_s_t_n_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            //pstn Station Information
            $table->string('exid', 200)->unique();
            $table->string('oprexid', 200)->nullable();
            $table->string('exname', 200)->nullable();
            $table->string('extype', 200)->nullable();
            $table->string('prtex', 200)->nullable();

            //Location Information
            $table->string('district', 200)->nullable();
            $table->string('vdc', 200)->nullable();
            $table->string('ward', 200)->nullable();
            $table->string('strtname', 200)->nullable();

            //Geo, Location in Decimal
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
        Schema::dropIfExists('p_s_t_n_s');
    }
}
