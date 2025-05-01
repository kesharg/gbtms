<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemsites', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('syssiteid',200)->unique();
            $table->string('oprcd',  200)->nullable();
            $table->string('oprsitename',200)->nullable();
            $table->string('oprsiteid',200)->nullable();


            //Address Information
            $table->string('province',200)->nullable();
            $table->string('district',200)->nullable();
            $table->string('vdc', 200)->nullable();
            $table->string('ward', 200)->nullable();
            $table->string('strtname', 200)->nullable();
            $table->string('anthtmsl', 200)->nullable();
            $table->string('anthtgl', 200)->nullable();
            $table->string('antbase', 200)->nullable();

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
        Schema::dropIfExists('systemsites');
    }
}
