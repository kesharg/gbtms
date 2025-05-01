<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVsatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vsats', function (Blueprint $table) {
            $table->bigIncrements('id');

            //VSAT Station Information
            $table->string('vsatid', 200)->unique();
            $table->string('oprcd', 200)->nullable();
            $table->string('oprvsatid', 200)->nullable();
            $table->string('vsatstnname', 200)->nullable();

            //Location Information
            $table->string('district', 200)->nullable();
            $table->string('vdc', 200)->nullable();
            $table->string('ward', 200)->nullable();
            $table->string('strtname', 200)->nullable();

            //Geo, Location in Decimal
            $table->string('lat', 200)->nullable();
            $table->string('long', 200)->nullable();
            $table->point('geom','GEOMETRY',4326)->nullable();

            //Operation Date And Time
            $table->string('oprfrom', 200)->nullable();
            $table->string('oprto', 200)->nullable();
            $table->string('purpose', 200)->nullable();

            //Carrier And Modulation Technique
            $table->string('uplink', 200)->nullable();
            $table->string('downlink', 200)->nullable();
            $table->string('modtechq', 200)->nullable();
            $table->string('stationtype', 200)->nullable();

            //Datarate, Model and Antenna
            $table->string('updatart', 200)->nullable();
            $table->string('dwndatart', 200)->nullable();
            $table->string('transpwr', 200)->nullable();
            $table->string('radiomodel', 200)->nullable();
            $table->string('antdia', 200)->nullable();
            $table->string('anthtmsl', 200)->nullable();

            //Uncategorized Data
            $table->string('status', 200)->nullable();
            $table->string('band_code', 200)->nullable();
            $table->string('band_width', 200)->nullable();
            $table->string('namesat', 200)->nullable();
            $table->string('satorient', 200)->nullable();
            $table->string('rurubr', 200)->nullable();
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
        Schema::dropIfExists('vsats');
    }
}
