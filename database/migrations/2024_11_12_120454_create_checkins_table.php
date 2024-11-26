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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->date('data_list')->nullable();
            $table->date('data_final')->nullable();
            $table->string('description')->nullable();
            $table->time('time_inicial')->nullable();
            $table->time('time_final')->nullable();
            $table->string('ordem')->nullable();
            $table->string('prioridade')->nullable();
            $table->string('icone')->nullable();
            $table->boolean('check')->default(true);
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
        Schema::dropIfExists('checkins');
    }
};
