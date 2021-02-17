<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClothCoordinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloth_coordination', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cloth_id')
                ->unsigned();
            $table->foreign('cloth_id')
                ->references('id')
                ->on('clothes')
                ->onDelete('cascade');
            $table->bigInteger('coordination_id')
                ->unsigned();
            $table->foreign('coordination_id')
                ->references('id')
                ->on('coordinations')
                ->onDelete('cascade');
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
        Schema::dropIfExists('cloth_coordination');
    }
}
