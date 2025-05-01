<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructurecodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructurecodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('infrastructure_name', 20)->nullable();
            $table->string('infrastructure_code', 20)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infrastructurecodes');
    }
}
