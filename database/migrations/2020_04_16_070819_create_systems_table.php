<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->bigIncrements('id');

            //Basic Information
            $table->string('oprcd',  200)->nullable();
            $table->string('syssiteid',200)->unique();
            $table->string('deviceid',200)->unique();
            $table->string('azimuth',200)->nullable();
            $table->string('tilt',200)->nullable();
            $table->string('antgain',200)->nullable();

            //Address Information
            $table->string('transpwr',200)->nullable();
            $table->string('sector', 200)->nullable();
            $table->string('txchanls', 200)->nullable();
            $table->string('rxchanls', 200)->nullable();
            $table->string('carbdwidth', 200)->nullable();

            //Tower Attributes
            $table->string('radiomodel',200)->nullable();
            $table->string('oprdate',200)->nullable();
            $table->string('polariz', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('band_code', 20)->nullable();
            $table->string('type', 20)->nullable();

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
        Schema::dropIfExists('systems');
    }
}
