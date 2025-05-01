<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWirelessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wirelesses', function (Blueprint $table) {
            $table->bigIncrements('id');
                    //Wireless Site Information
                    $table->string('wrlstid', 200)->unique();
                    $table->string('oprcd', 200)->nullable();
                    $table->string('oprsiteid', 200)->nullable();
                    $table->string('oprsitename', 200)->nullable();

                    //Location Information
                    $table->string('district', 200)->nullable();
                    $table->string('vdc', 200)->nullable();
                    $table->string('ward', 200)->nullable();
                    $table->string('strtname', 200)->nullable();

                    //Geo, Location in Decimal
                    $table->string('lat', 200)->nullable();
                    $table->string('long', 200)->nullable();
                    $table->point('geom','GEOMETRY',4326)->nullable();

                    $table->string('radiomodel', 200)->nullable();
                    $table->string('anthtmsl', 200)->nullable();

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
        Schema::dropIfExists('wirelesses');
    }
}
