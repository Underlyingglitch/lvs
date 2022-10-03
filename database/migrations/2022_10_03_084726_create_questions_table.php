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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leerling_id')->unsigned()->nullable();
            $table->bigInteger('buddie_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('content');
            $table->bigInteger('answer_id')->unsigned()->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();

            $table->foreign('leerling_id')->references('id')->on('leerlingen')->cascadeOnDelete();
            $table->foreign('buddie_id')->references('id')->on('buddies')->cascadeOnDelete();
            $table->foreign('answer_id')->references('id')->on('answers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
