<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrowavestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microwavestations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mwlinkid', 200)->unique();
            $table->string('oprcd', 200)->nullable();
            $table->string('oprlinkid', 200)->nullable();
            $table->string('linkname', 200)->nullable();
            $table->string('distance', 200)->nullable();
            $table->string('bdwidth', 200)->nullable();
            $table->string('polariz', 200)->nullable();
            $table->string('protection', 200)->nullable();
            $table->string('dateapprove', 200)->nullable();
            $table->string('mwstnname', 200)->nullable();
            $table->string('dateoprt', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('mwstncodea', 200)->nullable();
            $table->string('azimutha', 200)->nullable();
            $table->string('radiomodela', 200)->nullable();
            $table->string('txfrqa', 200)->nullable();
            $table->string('rxfrqa', 200)->nullable();
            $table->string('antdiaa', 200)->nullable();
            $table->string('antgaina', 200)->nullable();
            $table->string('txpowera', 200)->nullable();
            $table->string('rxpowera', 200)->nullable();
            $table->string('anthtgla', 200)->nullable();
            $table->string('mwstncodeb', 200)->nullable();
            $table->string('azimuthb', 200)->nullable();
            $table->string('radiomodelb', 200)->nullable();
            $table->string('txfrqb', 200)->nullable();
            $table->string('rxfrqb', 200)->nullable();
            $table->string('antdiab', 200)->nullable();
            $table->string('antgainb', 200)->nullable();
            $table->string('txpowerb', 200)->nullable();
            $table->string('rxpowerb', 200)->nullable();
            $table->string('anthtglb', 200)->nullable();
            $table->string('band_code', 200)->nullable();

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
        Schema::dropIfExists('microwavestations');
    }
}
