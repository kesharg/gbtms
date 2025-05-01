<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVdcsTable extends Migration {
    /**
    * Run the migrations.
    *
    * @return void
    */

    public function up() {
        Schema::create( 'vdcs', function ( Blueprint $table ) {
            $table->integer( 'state_code' );
            $table->string( 'district' );
            $table->string( 'vdc' );
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */

    public function down() {
        Schema::dropIfExists( 'vdcs' );
    }
}
