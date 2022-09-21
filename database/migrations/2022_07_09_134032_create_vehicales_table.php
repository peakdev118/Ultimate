<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicales', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('no');
            $table->string('name', 256);
            $table->string('category')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('town')->nullable();
            $table->string('district')->nullable();
            $table->integer('mobile')->unsigned();
            $table->date('start_date')->nullable();
            $table->string('land_line')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->string('passcort');
            
            
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
        Schema::dropIfExists('vehicales');
    }
}
