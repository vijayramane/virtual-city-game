<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_plays', function (Blueprint $table) {
            $table->id();
            $table->string('username', 64);
            $table->string('location', 64);
            $table->integer('scene');
            $table->integer('right_attempt')->nullable();
            $table->integer('wrong_attempt')->nullable();
            $table->integer('total_attempt')->nullable();
            $table->integer('total_time')->nullable();
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
        Schema::dropIfExists('game_plays');
    }
};
